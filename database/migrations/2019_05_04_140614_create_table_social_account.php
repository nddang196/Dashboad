<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSocialAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('social_account');
        Schema::create('social_account', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->comment('User ID');
            $table->string('provider_id', 25)->comment('Social Account ID');
            $table->unsignedTinyInteger('provider')->comment('Account Type');
            $table->timestamps();
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_account');
    }
}
