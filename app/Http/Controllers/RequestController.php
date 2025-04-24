<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Request as Permintaan;
use App\Models\RequestItem;
use App\Models\Item;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function index()
    {
        $requests = Permintaan::with(['user.department', 'items.item'])->latest()->get();
        return Inertia::render('Permintaan/Index', compact('requests'));
    }

    public function create()
    {
        return Inertia::render('Permintaan/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($validated) {
            $permintaan = Permintaan::create(['user_id' => $validated['user_id']]);

            foreach ($validated['items'] as $data) {
                $item = Item::find($data['item_id']);
                $qty = $data['quantity'];
                $status = 'terpenuhi';

                if ($item->stock == 0) throw new \Exception("Stok barang {$item->name} kosong!");
                if ($item->stock < $qty) {
                    $qty = $item->stock;
                    $status = 'sebagian';
                }

                $item->decrement('stock', $qty);

                RequestItem::create([
                    'request_id' => $permintaan->id,
                    'item_id' => $item->id,
                    'quantity' => $qty,
                    'status' => $status,
                ]);
            }
        });

        return redirect()->route('permintaan.index')->with('success', 'Permintaan berhasil disimpan.');
    }
}
