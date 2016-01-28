<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('series_id')->unsigned()->index();
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->string('title', 120);
            $table->text('description')->nullable();
            $table->enum('resource_type', ['vimeo', 'youtube', 'youku']);
            $table->integer('resource_id');
            $table->timestamp('published_at');
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
        Schema::drop('videos');
    }
}
