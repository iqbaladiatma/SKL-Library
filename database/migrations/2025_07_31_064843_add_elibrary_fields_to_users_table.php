<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('balance', 10, 2)->default(0.00)->after('is_admin');
            $table->string('subscription_type')->default('free')->after('balance');
            $table->timestamp('subscription_expires_at')->nullable()->after('subscription_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'balance',
                'subscription_type',
                'subscription_expires_at'
            ]);
        });
    }
};
