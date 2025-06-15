<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'subtitle',
        'description',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'type_id');
    }
}