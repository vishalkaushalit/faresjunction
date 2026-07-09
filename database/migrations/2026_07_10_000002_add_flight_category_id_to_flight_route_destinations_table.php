<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('flight_route_destinations', function (Blueprint $table) {
            if (! Schema::hasColumn('flight_route_destinations', 'flight_category_id')) {
                $table->foreignId('flight_category_id')
                    ->nullable()
                    ->after('id')
                    ->constrained()
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('flight_route_destinations', function (Blueprint $table) {
            if (Schema::hasColumn('flight_route_destinations', 'flight_category_id')) {
                $table->dropConstrainedForeignId('flight_category_id');
            }
        });
    }
};
