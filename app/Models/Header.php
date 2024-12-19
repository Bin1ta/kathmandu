<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Header extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'font',
        'font_size',
        'position',
        'font_color',
        'ward',
    ];

    protected $casts =[
        'font_size' => 'double',
    ];
}
