<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('nights_detail');
            $table->string('duration');
            $table->string('price');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->unsignedTinyInteger('stars')->default(5);
            $table->text('hero_image');
            $table->json('gallery')->nullable();
            $table->json('highlights')->nullable();
            $table->text('overview');
            $table->json('itinerary')->nullable();
            $table->json('inclusions')->nullable();
            $table->json('exclusions')->nullable();
            $table->json('hotels')->nullable();
            $table->json('activities')->nullable();
            $table->json('pricing')->nullable();
            $table->json('notes')->nullable();
            $table->json('reviews')->nullable();
            $table->json('related_slugs')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        // Preserve every package that powered the original static pages.
        require resource_path('views/layouts/includes/packages-data.php');
        $now = now();

        foreach ($packagesData as $slug => $package) {
            DB::table('packages')->insert([
                'title' => $package['title'],
                'slug' => $slug,
                'nights_detail' => $package['nightsDetail'],
                'duration' => $package['duration'],
                'price' => $package['price'],
                'rating' => $package['rating'] ?? 5,
                'stars' => $package['stars'] ?? 5,
                'hero_image' => $package['heroImage'],
                'gallery' => json_encode($package['gallery'] ?? []),
                'highlights' => json_encode($package['highlights'] ?? []),
                'overview' => $package['overview'],
                'itinerary' => json_encode($package['itinerary'] ?? []),
                'inclusions' => json_encode($package['inclusions'] ?? []),
                'exclusions' => json_encode($package['exclusions'] ?? []),
                'hotels' => json_encode($package['hotels'] ?? []),
                'activities' => json_encode($package['activities'] ?? []),
                'pricing' => json_encode($package['pricing'] ?? []),
                'notes' => json_encode($package['notes'] ?? []),
                'reviews' => json_encode($package['reviews'] ?? []),
                'related_slugs' => json_encode($package['related'] ?? []),
                'meta_title' => $package['title'].' | Fares Junction Packages',
                'meta_description' => $package['overview'],
                'status' => true,
                'sort_order' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
