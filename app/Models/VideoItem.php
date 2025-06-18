<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoItem extends Model
{
    protected $table = 'video_items';

    use HasFactory;

    protected $fillable = [
        'project_id',
        'image',
        'status',
    ];

    /**
     * Get the service this gallery belongs to
     */
    public function Project()
    {
        return $this->belongsTo(Project::class);
    }
}