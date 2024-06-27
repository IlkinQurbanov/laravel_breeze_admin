<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'content',
        'featured_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
