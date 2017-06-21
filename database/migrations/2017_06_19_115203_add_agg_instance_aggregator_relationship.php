<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAggInstanceAggregatorRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aggregator_instances', function (Blueprint $table) {
            $table->integer("codelist_collection_id")->nullable();
            $table->string("codelist_collection_uri")->nullable();
            $table->integer("aggregator_id")->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aggregator_instances', function (Blueprint $table) {
            $table->dropColumn("aggregator_id", "codelist_collection_id", "codelist_collection_uri");
        });
    }
}
