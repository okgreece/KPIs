<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAggregatorsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('aggregators', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->text('included');
            $table->text('excluded')->nullable()->default(null);
            $table->string('codelist')->nullable()->default(null);
            $table->timestamps();
        });
        
        Schema::create('aggregator_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('aggregator_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->string('locale')->index();
            $table->unique(['aggregator_id', 'locale']);
            $table->foreign('aggregator_id')->references('id')->on('aggregators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('aggregators');
        Schema::drop('aggregator_translations');
    }

}
