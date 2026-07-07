<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirlinePage extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'code',
        'intro',
        'routes',
        'faqs',
        'sections',
        'meta_title',
        'meta_description',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'routes' => 'array',
        'faqs' => 'array',
        'sections' => 'array',
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    public const SECTION_LABELS = [
        'overview' => 'Overview',
        'book-manage' => 'Book & Manage',
        'classes-seat' => 'Classes & Seat Selection',
        'checkin-onboard' => 'Check-in & Onboard',
        'baggage' => 'Baggage',
        'unaccompanied' => 'Unaccompanied Minor & Infant',
        'cancellation' => 'Cancellation & Refund',
        'flight-change' => 'Flight Name & Date Change',
        'pet-travel' => 'Pet Travel',
        'loyalty' => 'Loyalty Programs',
        'insurance' => 'Travel Insurance',
        'deals' => 'Flight Deals',
        'destinations' => 'Destinations',
        'cruises' => 'Cruises',
        'vacations' => 'Vacations',
    ];

    public function mergedSections(): array
    {
        $sections = $this->sections ?? [];

        return collect(self::SECTION_LABELS)
            ->mapWithKeys(fn (string $label, string $key): array => [
                $key => [
                    'title' => $sections[$key]['title'] ?? $label,
                    'body' => $sections[$key]['body'] ?? '',
                ],
            ])
            ->all();
    }
}
