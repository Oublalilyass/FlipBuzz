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
        Schema::create('business_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listing_id')->unique(); // One-to-one relationship
            
            $table->text('about_the_business')->nullable();
            $table->text('comparisons_benchmarking')->nullable();
            $table->json('revenue_expenses')->nullable();
            $table->json('performance_data')->nullable();
            $table->json('google_analytics_data')->nullable();
            $table->text('monetization_methods')->nullable();
            $table->text('products_services_used')->nullable();
            $table->text('sale_includes')->nullable();
            $table->text('social_media')->nullable();
            $table->json('attachments')->nullable();

            $table->timestamps();

            // Add foreign key constraint for listing_id
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_details');
    }
};
