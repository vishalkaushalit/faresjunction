<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class FlightRouteDestination extends Model
{
    public const TYPE_ROUTE = 'route';
    public const TYPE_DESTINATION = 'destination';

    public const TYPES = [
        self::TYPE_ROUTE,
        self::TYPE_DESTINATION,
    ];

    public const TRIP_TYPES = [
        'one_way' => 'One Way',
        'round_trip' => 'Round Trip',
        'multi_city' => 'Multi City',
    ];

    public const CABIN_CLASSES = [
        'Economy' => 'Economy',
        'Premium Economy' => 'Premium Economy',
        'Businesss' => 'Businesss',
    ];

    protected $fillable = [
        'type',
        'flight_category_id',
        'image_path',
        'image_original_name',
        'route_text',
        'slug',
        'trip_type',
        'cabin_class',
        'pricing',
        'tag',
        'description',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(FlightCategory::class, 'flight_category_id');
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

    public function getTripTypeLabelAttribute(): string
    {
        return self::TRIP_TYPES[$this->trip_type] ?? $this->trip_type;
    }
}
