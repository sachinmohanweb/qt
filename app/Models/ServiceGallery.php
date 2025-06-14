<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'image',
        'status',
    ];

    /**
     * Get the service this gallery belongs to
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}