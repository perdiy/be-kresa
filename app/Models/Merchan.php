<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchan extends Model
{
    use HasFactory;
    protected $table = 'merchan';
    protected $fillable = ['ttle','desc ','image1','image2','image3'];
}
