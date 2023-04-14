<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;
    protected $table = 'work';
    protected $fillable = ['title','desc ','image','image1','image2','image3','image4','image5'];
}
