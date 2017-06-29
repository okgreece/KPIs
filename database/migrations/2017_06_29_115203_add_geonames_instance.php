<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGeonamesInstance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->integer("geonames_instance_id")->nullable();
            //
        });
        Schema::create('geonames_instances', function(Blueprint $table) {
            $table->increments('id');
            $table->string("geonames_id");
            $table->string("country")->nullable();
            $table->string("continent")->nullable();
            $table->string("level")->nullable();
            $table->string("adm1")->nullable();
            $table->string("adm2")->nullable();
            $table->string("adm3")->nullable();
            $table->string("adm4")->nullable();
            $table->string("dbpedia")->nullable();
            $table->string("wikipedia")->nullable();
            $table->string("map")->nullable();
            $table->decimal("long")->nullable();
            $table->decimal("lat")->nullable();
            $table->string("type")->nullable();
            $table->integer("population")->nullable();
            $table->timestamps();
        });
        
        Schema::create('geonames_instances_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('geonames_instance_id')->unsigned();
            $table->string('label');
            $table->text('altlabel');
            $table->string('locale')->index();
            $table->unique(['geonames_instance_id', 'locale']);
            $table->foreign('geonames_instance_id')->references('id')->on('geonames_instances')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn("geonames_instance_id");
        });
        
        Schema::drop('geonames_instances');
        Schema::drop('geonames_instances_translations');
    }
}