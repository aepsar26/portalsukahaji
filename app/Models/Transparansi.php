<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transparansi extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis',
        'jumlah'
    ];

    protected $casts = [
        'jumlah' => 'decimal:2'
    ];
}