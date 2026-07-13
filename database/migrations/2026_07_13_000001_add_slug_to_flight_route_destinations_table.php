<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('flight_route_destinations', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('route_text');
        });

        DB::table('flight_route_destinations')
            ->select(['id', 'route_text'])
            ->orderBy('id')
            ->each(function (object $item): void {
                $baseSlug = Str::slug($item->route_text) ?: 'flight-page';
                $slug = $baseSlug;
                $suffix = 2;

                while (DB::table('flight_route_destinations')->where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $suffix++;
                }

                DB::table('flight_route_destinations')
                    ->where('id', $item->id)
                    ->update(['slug' => $slug]);
            });

        Schema::table('flight_route_destinations', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('flight_route_destinations', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
