<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'services';

    use HasFactory;

    protected $fillable = [
        'menu_item_id',
        'name',
        'subtitle',
        'image',
        'home_visibility',
        'status',
    ];

    /**
     * Get the service type
     */
    public function MenuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }

    /**
     * Get the gallery images for this service
     */
    public function ProjectImages()
    {
        return $this->hasMany(ProjectImage::class);
    }
}