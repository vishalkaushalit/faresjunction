<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flight_route_destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type');
            $table->string('image_path')->nullable();
            $table->string('image_original_name')->nullable();
            $table->string('route_text');
            $table->string('trip_type');
            $table->string('cabin_class');
            $table->string('pricing')->nullable();
            $table->string('tag')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flight_route_destinations');
    }
};
