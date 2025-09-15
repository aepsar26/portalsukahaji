<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemerintahan extends Model
{
    protected $fillable = ['name', 'position', 'description', 'photo'];
}
