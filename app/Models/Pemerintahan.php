<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemerintahan extends Model
{
    protected $fillable = [
        'name',
        'nip',        // ✅ tambahkan nip di sini
        'position',
        'description',
        'photo',
    ];
}
