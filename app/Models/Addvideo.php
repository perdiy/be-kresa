<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addvideo extends Model
{
    use HasFactory;
    protected $table = 'addvideo';
    protected $fillable = ['chanel','id_video','image'];
}
