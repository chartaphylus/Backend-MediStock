<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = ['nama_obat', 'kategori_id', 'stock', 'tanggal_kadaluarsa', 'harga', 'updated_by'];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
