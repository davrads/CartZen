<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('flash_sales', function (Blueprint $table) {
            // Add columns if they don't exist
            if (!Schema::hasColumn('flash_sales', 'start_date')) {
                $table->dateTime('start_date')->nullable()->after('product_id');
            }
            if (!Schema::hasColumn('flash_sales', 'end_date')) {
                $table->dateTime('end_date')->nullable()->after('start_date');
            }
            if (!Schema::hasColumn('flash_sales', 'name')) {
                $table->string('name')->nullable()->after('id');
            }
            if (!Schema::hasColumn('flash_sales', 'flash_price')) {
                $table->decimal('flash_price', 10, 2)->nullable()->after('product_id');
            }
        });
    }

    public function down()
    {
        Schema::table('flash_sales', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'end_date', 'name', 'flash_price']);
        });
    }
};