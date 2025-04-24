<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Item;
use App\Models\Permintaan;
use App\Models\RequestItem;
use Illuminate\Support\Facades\DB;

class PermintaanController extends Controller
{
    public function index()
    {
        $requests = Permintaan::with(['user.department', 'items.item'])->latest()->get();
        return Inertia::render('Permintaan/Index', [
            'requests' => $requests,
        ]);
    }

    public function create()
    {
        $items = \App\Models\Item::all(); 

        $data = [
            'items' => $items,
        ];

        return Inertia::render('Permintaan/Create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
        
        DB::transaction(function () use ($validated) {
            $permintaan = Permintaan::create([
                'user_id' => auth()->id(),
            ]);
            
            foreach ($validated['items'] as $data) {
                $item = Item::findOrFail($data['item_id']);
                $qty = $data['quantity'];
                $status = 'terpenuhi';

                if ($item->stock === 0) {
                    throw new \Exception("Stok barang {$item->name} kosong!");
                }

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
