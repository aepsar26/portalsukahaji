<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = ['leader_id', 'name', 'position', 'photo'];

    public function leader()
    {
        return $this->belongsTo(Leader::class);
    }
}
