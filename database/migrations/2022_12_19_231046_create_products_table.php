<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('parent_id')->constrained('categories')->restrictOnDelete();
            $table->text('descraption')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedFloat('price')->default(0);
            $table->unsignedFloat('sale_price')->default(0);
            $table->unsignedFloat('quantity')->default(0);
            $table->string('sku')->unique()->nullable();
            $table->unsignedFloat('weight')->nullable();
            $table->unsignedFloat('hight')->nullable();
            $table->unsignedFloat('length')->nullable();
            $table->unsignedFloat('width')->nullable();
            $table->enum('status',[Product::STATUS_ACTIVE,Product::STATUS_DRAFT]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
