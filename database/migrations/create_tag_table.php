<?php

use FrenchFrogs\Laravel\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tag_container', function(Blueprint $table){

            $table->binaryUuid('tag_container_id')->primary();
            $table->string('title', 64);
            $table->string('description', 512);
            $table->boolean('active')->default(1);

            $table->timestamp('created_at');

        });


        Schema::create('tag_route', function(Blueprint $table){

            $table->binaryUuid('tag_route_id')->primary();
            $table->binaryUuid('tag_container_id');
            $table->string('route', 256);

            $table->foreign('tag_container_id')->references('tag_container_id')->on('tag_container');
        });

        Schema::create('tag', function(Blueprint $table){

            $table->binaryUuid('tag_id')->primary();
            $table->binaryUuid('tag_container_id');
            $table->longText('content');
            $table->string('data', 512)->nullable();
            $table->enum('position', ['inline', 'head']);

            $table->foreign('tag_container_id')->references('tag_container_id')->on('tag_container');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tag_route', function ($table) {
            $table->dropForeign('tag_container_id');
        });
        Schema::dropIfExists('tag_route');

        Schema::table('tag', function ($table) {
            $table->dropForeign('tag_container_id');
        });
        Schema::dropIfExists('tag');

        Schema::dropIfExists('tag_container');
    }
}