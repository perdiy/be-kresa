<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page1 extends Model
{
    use HasFactory;
    protected $table = 'page1';
    protected $fillable = ['title','desc','image1','image2','image3'];
    
}
