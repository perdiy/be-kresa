<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video5 extends Model
{

    use HasFactory;
    protected $table = 'video5';
    protected $fillable = ['link','thumb','title','desc','title_section1','desc_section1','title_section2','desc_section2','title_section3','desc_section3','imageanimasi'];
}
