<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->timestamps();
        });
        
         Schema::create('group_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->string('locale')->index();
            $table->unique(['group_id', 'locale']);
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('groups');
        Schema::drop('group_translations');
    }
}
