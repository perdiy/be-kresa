<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $table = 'about';
    protected $fillable = ['image','image1','image2','image3','title_section1','desc_section1','title_section2','desc_section2','title_section3','desc_section3'];
}
