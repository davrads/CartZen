<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_products_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->cascadeOnDelete(); // Link to the vendor
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete(); // Link to the category
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('brand')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('price', 10, 2);
           $table->decimal('sale_price', 10, 2)->nullable();
            $table->integer('stock');
            $table->string('thumbnail')->nullable();
            $table->enum('status', ['available', 'out_of_stock'])->default('available');
            $table->boolean('featured')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};