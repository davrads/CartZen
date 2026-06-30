<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Only add columns that don't already exist
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('total_amount');
            }

            if (!Schema::hasColumn('orders', 'khalti_pidx')) {
                $table->string('khalti_pidx')->nullable()->after('payment_method');
            }

            if (!Schema::hasColumn('orders', 'meta')) {
                $table->json('meta')->nullable()->after('khalti_pidx');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop only if they exist
            if (Schema::hasColumn('orders', 'payment_method')) {
                $table->dropColumn('payment_method');
            }
            if (Schema::hasColumn('orders', 'khalti_pidx')) {
                $table->dropColumn('khalti_pidx');
            }
            if (Schema::hasColumn('orders', 'meta')) {
                $table->dropColumn('meta');
            }
        });
    }
};