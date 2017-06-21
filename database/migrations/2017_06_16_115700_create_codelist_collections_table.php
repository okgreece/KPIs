<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodelistCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codelist_collections', function(Blueprint $table) {
            $table->increments('id');
            $table->string('codelist');
            $table->text('included');
            $table->text('excluded')->nullable();
            $table->timestamps();
        });
        
        Schema::create('codelist_collections_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('codelist_collection_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->string('locale')->index();
            $table->unique(['codelist_collection_id', 'locale']);
            $table->foreign('codelist_collection_id')->references('id')->on('codelist_collections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('codelist_collections');
        Schema::drop('codelist_collections_translations');
    }
}
