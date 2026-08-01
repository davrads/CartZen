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
        Schema::table('products', function (Blueprint $table) {
            $table->enum('verification_status', [
                'pending',
                'approved',
                'rejected',
            ])->default('pending')->after('status');

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->after('verification_status');

            $table->timestamp('verified_at')
                ->nullable()
                ->after('verified_by');

            $table->text('rejection_reason')
                ->nullable()
                ->after('verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);

            $table->dropColumn([
                'verification_status',
                'verified_by',
                'verified_at',
                'rejection_reason',
            ]);
        });
    }
};
