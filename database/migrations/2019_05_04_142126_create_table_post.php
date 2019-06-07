<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('blog_post');
        Schema::create('blog_post', function (Blueprint $table) {
            $table->increments('id')->comment('Post ID');
            $table->unsignedInteger('admin_id', 25)->comment('Admin ID');
            $table->string('title', 100)
                ->nullable(false)
                ->comment('Post Title');
            $table->text('short_description')
                ->nullable(false)
                ->comment('Short Description');
            $table->longText('description')
                ->nullable(false)
                ->comment('Description');
            $table->unsignedTinyInteger('status')
                ->nullable(false)
                ->default(0)
                ->comment('Status');
            $table->boolean('is_active')
                ->nullable(false)
                ->default(0)
                ->comment('Is Active');
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post');
    }
}
