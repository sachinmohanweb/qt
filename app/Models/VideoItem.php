<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoItem extends Model
{
    protected $table = 'video_items';

    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'link_path',
        'thumb',
        'home_visibility',
        'status',
    ];
   
}