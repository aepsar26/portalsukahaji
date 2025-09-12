<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanans'; // sesuai nama tabel di database
    protected $fillable = ['judul', 'deskripsi']; // sesuaikan kolom yang ada
}
