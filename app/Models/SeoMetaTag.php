<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class SeoMetaTag extends Model
{
    protected $fillable = [
        'page_type',
        'page_key',
        'page_name',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public static function findActive(string $pageType, string $pageKey): ?self
    {
        try {
            return self::query()
                ->where('page_type', $pageType)
                ->where('page_key', $pageKey)
                ->where('status', true)
                ->first();
        } catch (QueryException) {
            return null;
        }
    }
}
