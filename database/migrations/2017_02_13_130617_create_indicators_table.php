<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicators', function(Blueprint $table) {
            $table->increments('id');
            $table->string('indicator');
            $table->integer('group');
            $table->boolean('enabled');
            $table->string('type');
            $table->integer('nominator');
            $table->integer('denominator');
            $table->timestamps();
        });
        
        Schema::create('indicator_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('indicator_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->string('locale')->index();
            $table->unique(['indicator_id', 'locale']);
            $table->foreign('indicator_id')->references('id')->on('indicators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('indicators');
        Schema::drop('indicator_translations');
    }
}
