<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'slug',
        'user_name',
        'description',
        'image',
        'date',
        'home_visibility',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Generate slug from heading
     */
    public static function generateSlug($heading, $id = null)
    {
        $slug = Str::slug($heading);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->when($id, function ($query, $id) {
            return $query->where('id', '!=', $id);
        })->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    /**
     * Boot method to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = static::generateSlug($blog->heading);
            }
        });

        static::updating(function ($blog) {
            if ($blog->isDirty('heading')) {
                $blog->slug = static::generateSlug($blog->heading, $blog->id);
            }
        });
    }
}