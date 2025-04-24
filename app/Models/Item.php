<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    // protected $fillable = ['name', 'location', 'stock', 'unit'];
    protected $fillable = ['name', 'stock', 'unit'];

    public function requestItems()
    {
        return $this->hasMany(RequestItem::class);
    }
}
