<?php

namespace app\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kategoriLabels = Kategori::withCount('obats')->get();

        $stockHabis = Obat::where('stock', '<=', 10)->get();
        $kadaluarsa = Obat::whereDate('tanggal_kadaluarsa', '<=', now()->addDays(7))->get();

        return view('user.dashboard', [
            'kategoriLabels' => $kategoriLabels,
            'stockHabis' => $stockHabis,
            'kadaluarsa' => $kadaluarsa,
        ]);
    }
}
