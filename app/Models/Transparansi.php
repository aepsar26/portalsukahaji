<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transparansi extends Model
{
    protected $table = 'transparansis'; // sesuai nama tabel
    protected $fillable = ['jenis', 'jumlah']; // sesuaikan kolom yang ada
}
