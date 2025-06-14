<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'name',
        'image',
        'status',
    ];

    /**
     * Get the service type
     */
    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'type_id');
    }

    /**
     * Get the gallery images for this service
     */
    public function galleries()
    {
        return $this->hasMany(ServiceGallery::class);
    }
}