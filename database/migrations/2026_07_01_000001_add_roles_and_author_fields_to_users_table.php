<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default(User::ROLE_AUTHOR)->after('email');
            $table->unsignedTinyInteger('age')->nullable()->after('name');
            $table->string('experience')->nullable()->after('age');
            $table->string('social_media_profile')->nullable()->after('experience');
            $table->string('contact_number', 30)->nullable()->after('social_media_profile');
            $table->string('profile_image')->nullable()->after('contact_number');
        });

        DB::table('users')->update(['role' => User::ROLE_ADMIN]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'age',
                'experience',
                'social_media_profile',
                'contact_number',
                'profile_image',
            ]);
        });
    }
};
