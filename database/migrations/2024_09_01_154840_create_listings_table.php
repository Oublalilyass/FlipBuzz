<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('type');
            $table->string('images')->nullable();
            $table->integer('site_age')->nullable();
            $table->decimal('monthly_profit', 10, 2)->nullable();
            $table->decimal('profit_margin', 5, 2)->nullable();
            $table->integer('page_views')->nullable();
            $table->decimal('profit_multiple', 5, 2)->nullable();
            $table->integer('revenue_multiple')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
};
