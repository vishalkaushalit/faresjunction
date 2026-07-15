<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->nullable()->constrained('packages')->nullOnDelete();
            $table->string('source', 50)->default('package');
            $table->string('interest')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 30);
            $table->date('travel_date');
            $table->unsignedSmallInteger('traveler_count')->default(1);
            $table->text('message')->nullable();
            $table->timestamp('admin_notified_at')->nullable();
            $table->timestamp('user_notified_at')->nullable();
            $table->text('notification_error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_inquiries');
    }
};
