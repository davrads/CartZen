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
        if (!Schema::hasTable('reviews')) {
            Schema::create('reviews', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->foreignId('product_id')->constrained()->cascadeOnDelete();
                // कुन order item बाट यो review आयो भनेर ट्रयाक गर्न (duplicate review रोक्नका लागि पनि प्रयोग हुन्छ)
                $table->foreignId('order_item_id')->nullable()->constrained()->nullOnDelete();
                $table->unsignedTinyInteger('rating');
                $table->text('comment')->nullable();
                $table->timestamps();
            });

            return;
        }

        // reviews table पहिल्यै अवस्थित छ भने, छुटेका column मात्र थप्ने
        Schema::table('reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            }
            if (!Schema::hasColumn('reviews', 'product_id')) {
                $table->foreignId('product_id')->nullable()->constrained()->cascadeOnDelete();
            }
            if (!Schema::hasColumn('reviews', 'order_item_id')) {
                $table->foreignId('order_item_id')->nullable()->constrained()->nullOnDelete();
            }
            if (!Schema::hasColumn('reviews', 'rating')) {
                $table->unsignedTinyInteger('rating')->default(5);
            }
            if (!Schema::hasColumn('reviews', 'comment')) {
                $table->text('comment')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Table अघिबाटै अवस्थित हुन सक्ने भएकोले (माथि हेर्नुहोस्), सुरक्षाको लागि यहाँ केही ड्रप गरिँदैन।
        // पूर्ण रूपमा हटाउनु परे: Schema::dropIfExists('reviews');
    }
};