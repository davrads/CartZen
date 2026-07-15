<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // is_flash_deal – boolean, default false
            $table->boolean('is_flash_deal')->default(false)->after('featured');
            // flash_deal_ends_at – nullable datetime
            $table->dateTime('flash_deal_ends_at')->nullable()->after('is_flash_deal');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_flash_deal', 'flash_deal_ends_at']);
        });
    }
};