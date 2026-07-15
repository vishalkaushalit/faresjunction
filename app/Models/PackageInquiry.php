<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageInquiry extends Model
{
    protected $fillable = [
        'package_id', 'source', 'interest', 'name', 'email', 'phone',
        'travel_date', 'traveler_count', 'message', 'admin_notified_at',
        'user_notified_at', 'notification_error',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'traveler_count' => 'integer',
        'admin_notified_at' => 'datetime',
        'user_notified_at' => 'datetime',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
