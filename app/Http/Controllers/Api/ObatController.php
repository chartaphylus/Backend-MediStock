<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::with('kategori')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Obat',
            'data' => $obat
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_obat' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'stock' => 'required|integer',
            'tanggal_kadaluarsa' => 'required|date',
            'harga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $obat = Obat::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Obat berhasil ditambahkan',
            'data' => $obat
        ]);
    }

    public function show($id)
    {
        $obat = Obat::with('kategori')->find($id);

        if (!$obat) {
            return response()->json([
                'success' => false,
                'message' => 'Obat tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Obat',
            'data' => $obat
        ]);
    }

    public function update(Request $request, $id)
    {
        $obat = Obat::find($id);

        if (!$obat) {
            return response()->json([
                'success' => false,
                'message' => 'Obat tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_obat' => 'sometimes|required|string',
            'kategori_id' => 'sometimes|required|exists:kategoris,id',
            'stock' => 'sometimes|required|integer',
            'tanggal_kadaluarsa' => 'sometimes|required|date',
            'harga' => 'sometimes|required|numeric',
            'updated_by' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $obat->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Obat berhasil diperbarui',
            'data' => $obat
        ]);
    }

    public function destroy($id)
    {
        $obat = Obat::find($id);

        if (!$obat) {
            return response()->json([
                'success' => false,
                'message' => 'Obat tidak ditemukan',
            ], 404);
        }

        $obat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Obat berhasil dihapus',
        ]);
    }
}
