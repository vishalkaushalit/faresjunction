<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = [
        'title', 'slug', 'nights_detail', 'duration', 'price', 'rating', 'stars',
        'hero_image', 'gallery', 'highlights', 'overview', 'itinerary', 'inclusions',
        'exclusions', 'hotels', 'activities', 'pricing', 'notes', 'reviews',
        'related_slugs', 'meta_title', 'meta_description', 'status', 'sort_order',
    ];

    protected $casts = [
        'gallery' => 'array',
        'highlights' => 'array',
        'itinerary' => 'array',
        'inclusions' => 'array',
        'exclusions' => 'array',
        'hotels' => 'array',
        'activities' => 'array',
        'pricing' => 'array',
        'notes' => 'array',
        'reviews' => 'array',
        'related_slugs' => 'array',
        'rating' => 'integer',
        'stars' => 'integer',
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function websiteData(): array
    {
        return [
            'title' => $this->title,
            'nightsDetail' => $this->nights_detail,
            'duration' => $this->duration,
            'price' => $this->price,
            'rating' => $this->rating,
            'stars' => $this->stars,
            'heroImage' => $this->imageUrl($this->hero_image),
            'gallery' => collect($this->gallery ?: array_filter([$this->hero_image]))
                ->map(fn (string $image): string => $this->imageUrl($image))->all(),
            'highlights' => $this->highlights ?? [],
            'overview' => $this->overview,
            'itinerary' => $this->itinerary ?? [],
            'inclusions' => $this->inclusions ?? [],
            'exclusions' => $this->exclusions ?? [],
            'hotels' => collect($this->hotels ?? [])->map(function (array $hotel): array {
                if (isset($hotel['rating']) && is_numeric($hotel['rating'])) {
                    $rating = max(1, min(5, (int) $hotel['rating']));
                    $hotel['rating'] = str_repeat('★', $rating).str_repeat('☆', 5 - $rating);
                }

                return $hotel;
            })->all(),
            'activities' => collect($this->activities ?? [])->map(function (array $activity): array {
                if (! empty($activity['image'])) {
                    $activity['image'] = $this->imageUrl($activity['image']);
                }

                return $activity;
            })->all(),
            'pricing' => $this->pricing ?? [],
            'notes' => $this->notes ?? [],
            'reviews' => $this->reviews ?? [],
            'related' => $this->related_slugs ?? [],
        ];
    }

    public function imageUrl(?string $image): string
    {
        if (! $image) {
            return '';
        }

        return Str::startsWith($image, ['http://', 'https://', '/'])
            ? $image
            : asset('storage/'.$image);
    }
}
