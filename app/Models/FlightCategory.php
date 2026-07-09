<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class FlightCategory extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'image_path',
        'image_original_name',
    ];

    protected $appends = [
        'posts_count',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image_path) {
            return null;
        }

        if (Str::startsWith($this->image_path, ['http://', 'https://', '/'])) {
            return $this->image_path;
        }

        return asset('storage/' . $this->image_path);
    }

    public function getPostsCountAttribute(): int
    {
        return 0;
    }
}
