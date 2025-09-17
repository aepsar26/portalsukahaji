<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $fillable = [
        'name',
        'nip',       // ✅ tambahkan nip di sini
        'position',
        'photo',
    ];

    public function staff()
    {
        return $this->hasMany(Staff::class, 'leader_id');
    }
}
