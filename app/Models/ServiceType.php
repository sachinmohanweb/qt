<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'subtitle',
        'description',
        'status',
    ];

    /**
     * Get the services for this type
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'type_id');
    }
}