<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('review');
        Schema::create('review', function (Blueprint $table) {
            $table->increments('id')->comment('Review ID');
            $table->unsignedInteger('user_id', 25)->nullable()->comment('User ID');
            $table->unsignedInteger('post_id', 25)->nullable(false)->comment('Post ID');
            $table->unsignedInteger('point')->comment('Point');
            $table->text('short_description')->comment('Short Description');
            $table->longText('description')->comment('Description');
            $table->unsignedTinyInteger('status')->comment('Status');
            $table->boolean('is_active')->comment('Is Active');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('post_id')->references('id')->on('blog_post')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review');
    }
}
