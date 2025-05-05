<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SaranKesehatan;

class SaranKesehatanController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => SaranKesehatan::latest()->get()
        ]);
    }
}
