<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaranKesehatan extends Model
{
    protected $table = 'saran_kesehatans';

    protected $fillable = [
        'judul',
        'isi',
    ];
}
