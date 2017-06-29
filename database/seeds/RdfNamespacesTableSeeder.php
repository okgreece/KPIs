<?php

use Illuminate\Database\Seeder;

class RdfNamespacesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rdf_namespaces')->delete();
        
        \DB::table('rdf_namespaces')->insert(array (
            0 => 
            array (
                'id' => '1',
                'prefix' => 'gr-dimension',
                'url' => 'http://data.openbudgets.eu/ontology/dsd/greek-municipalities/dimension/',
                'created_at' => '2017-04-27 16:13:16',
                'updated_at' => '2017-04-27 16:43:24',
            ),
            1 => 
            array (
                'id' => '2',
                'prefix' => 'obeu-budgetphase',
                'url' => 'http://data.openbudgets.eu/resource/codelist/budget-phase/',
                'created_at' => '2017-04-27 16:44:36',
                'updated_at' => '2017-04-27 16:44:36',
            ),
            2 => 
            array (
                'id' => '3',
                'prefix' => 'obeu-measure',
                'url' => 'http://data.openbudgets.eu/ontology/dsd/measure/',
                'created_at' => '2017-04-27 16:45:18',
                'updated_at' => '2017-04-27 16:45:18',
            ),
            3 => 
            array (
                'id' => '4',
                'prefix' => 'obeu-dimension',
                'url' => 'http://data.openbudgets.eu/ontology/dsd/dimension/',
                'created_at' => '2017-04-27 16:45:47',
                'updated_at' => '2017-04-27 16:45:47',
            ),
            4 => 
            array (
                'id' => '5',
                'prefix' => 'obeu-operation',
                'url' => 'http://data.openbudgets.eu/resource/codelist/operation-character/',
                'created_at' => '2017-04-27 16:46:13',
                'updated_at' => '2017-04-27 16:46:13',
            ),
            5 => 
            array (
                'id' => '6',
                'prefix' => 'qb',
                'url' => 'http://purl.org/linked-data/cube#',
                'created_at' => '2017-04-27 16:46:37',
                'updated_at' => '2017-04-27 16:46:37',
            ),
            6 => 
            array (
                'id' => '7',
                'prefix' => 'skos',
                'url' => 'http://www.w3.org/2004/02/skos/core#',
                'created_at' => '2017-04-27 16:47:06',
                'updated_at' => '2017-04-27 16:47:06',
            ),
            7 => 
            array (
                'id' => '8',
                'prefix' => 'dbpedia-el',
                'url' => 'http://el.dbpedia.org/resource/',
                'created_at' => '2017-04-27 16:47:34',
                'updated_at' => '2017-04-27 16:47:34',
            ),
            8 => 
            array (
                'id' => '9',
                'prefix' => 'dbpedia',
                'url' => 'http://dbpedia.org/resource/',
                'created_at' => '2017-04-27 16:47:59',
                'updated_at' => '2017-04-27 16:47:59',
            ),
            9 => 
            array (
                'id' => '10',
                'prefix' => 'gn',
                'url' => 'http://sws.geonames.org/',
                'created_at' => '2017-04-27 16:48:23',
                'updated_at' => '2017-04-27 16:48:23',
            ),
            10 => 
            array (
                'id' => '11',
                'prefix' => 'rdfs',
                'url' => 'http://www.w3.org/2000/01/rdf-schema#',
                'created_at' => '2017-04-27 17:36:24',
                'updated_at' => '2017-04-27 17:36:24',
            ),
            11 => 
            array (
                'id' => '12',
                'prefix' => 'rdf',
                'url' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
                'created_at' => '2017-04-27 17:37:17',
                'updated_at' => '2017-04-27 17:37:17',
            ),
        ));
        
        
    }
}