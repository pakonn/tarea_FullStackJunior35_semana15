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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cantidad');
            $table->foreignId('product_id')
                  ->constrained('products','id')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();             
            $table->foreignId('order_id')
                  ->constrained('orders','id')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();  
            $table->softDeletes();                     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
