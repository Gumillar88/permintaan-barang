<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Item;

class ApiController extends Controller
{
    public function getUserByNik($nik)
    {
        return User::with('department')->where('nik', $nik)->firstOrFail();
    }

    public function getItems()
    {
        return Item::all();
    }
}
