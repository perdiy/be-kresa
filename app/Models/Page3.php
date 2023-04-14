<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page3 extends Model
{
    use HasFactory;
    protected $table = 'page3';
    protected $fillable = ['ttle','desc ','image1','image2','image3','imageteam','title_section1','desc_section1','title_section2','desc_section2','title_section3','desc_section3'];
}
 