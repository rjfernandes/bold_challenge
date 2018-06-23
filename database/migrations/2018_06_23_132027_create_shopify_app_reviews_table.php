<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopifyAppReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopify_app_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shopify_domain', 255);
            $table->string('app_slug', 255);
            $table->integer('star_rating')->nullable();
            $table->integer('previous_star_rating')->nullable();
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
        Schema::dropIfExists('shopify_app_reviews');
    }
}
