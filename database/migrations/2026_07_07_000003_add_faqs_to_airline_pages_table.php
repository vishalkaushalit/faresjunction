<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('airline_pages', function (Blueprint $table) {
            $table->json('faqs')->nullable()->after('routes');
        });

        DB::table('airline_pages')
            ->orderBy('id')
            ->select(['id', 'name'])
            ->get()
            ->each(function (object $airlinePage): void {
                DB::table('airline_pages')
                    ->where('id', $airlinePage->id)
                    ->update([
                        'faqs' => json_encode([
                            [
                                'question' => "How can I check-in for my {$airlinePage->name} flight?",
                                'answer' => 'You can check in online through the airline website, mobile app, or at the airport using self-service kiosks and check-in counters.',
                            ],
                            [
                                'question' => "What is the baggage allowance for {$airlinePage->name}?",
                                'answer' => 'Baggage allowance varies by ticket class, route, and fare rules. Most passengers can bring one carry-on bag and one personal item.',
                            ],
                            [
                                'question' => "Can I cancel or change my {$airlinePage->name} booking?",
                                'answer' => 'Yes, you can modify or cancel your booking through the Manage Booking section. Fees and policies depend on your fare type and how far in advance you make the change.',
                            ],
                        ]),
                    ]);
            });
    }

    public function down(): void
    {
        Schema::table('airline_pages', function (Blueprint $table) {
            $table->dropColumn('faqs');
        });
    }
};
