<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [ 'name' => 'Pulpen', 'stock' => 10, 'unit' => 'pcs', 'location' => 'Gudang A' ],
            [ 'name' => 'Kertas A4', 'stock' => 50, 'unit' => 'rim', 'location' => 'Gudang A' ],
            [ 'name' => 'Stapler', 'stock' => 5, 'unit' => 'pcs', 'location' => 'Gudang B' ],
            [ 'name' => 'Spidol', 'stock' => 20, 'unit' => 'pcs', 'location' => 'Gudang B' ],
            [ 'name' => 'Penggaris', 'stock' => 8, 'unit' => 'pcs', 'location' => 'Gudang A' ],
            [ 'name' => 'Amplop', 'stock' => 100, 'unit' => 'pcs', 'location' => 'Gudang C' ],
            [ 'name' => 'Map Folder', 'stock' => 40, 'unit' => 'pcs', 'location' => 'Gudang C' ],
            [ 'name' => 'Sticky Note', 'stock' => 30, 'unit' => 'pcs', 'location' => 'Gudang B' ],
            [ 'name' => 'Tinta Printer', 'stock' => 3, 'unit' => 'botol', 'location' => 'Gudang D' ],
            [ 'name' => 'Paper Clip', 'stock' => 200, 'unit' => 'pcs', 'location' => 'Gudang A' ]
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
