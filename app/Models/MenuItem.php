<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuItem extends Model
{

    protected $table = 'service_types';

    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'slug',
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

    public function projects()
    {
        return $this->hasMany(Project::class, 'menu_item_id');
    }
}