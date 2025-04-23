<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ObatExport;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        $query = Obat::query();

        if ($request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }

        if ($request->search) {
            $query->where('nama_obat', 'like', "%{$request->search}%");
        }

        $obats = $query->paginate(10);
        $kategoris = Kategori::all();

        return view('user.obat.index', compact('obats', 'kategoris'));
    }

    public function export()
    {
        return Excel::download(new ObatExport, 'data_obat.xlsx');
    }
    
    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);
        $obat->update($request->all());

        return redirect()->back()->with('success', 'Data obat berhasil diperbarui!');
    }

}
