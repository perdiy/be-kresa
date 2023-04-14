<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time_line extends Model
{
    use HasFactory;
    protected $table = 'time_line';
    protected $fillable = ['year','month','client','image'];
}
