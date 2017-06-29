<?php

use Illuminate\Database\Seeder;

class AggregatorsTableSeederBackup extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('aggregators')->delete();
        
        \DB::table('aggregators')->insert(array (
            0 => 
            array (
                'id' => '6',
                'code' => 'regular_income',
                'included' => '0',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-esodwn-2014/',
                'created_at' => '2017-02-19 07:43:13',
                'updated_at' => '2017-02-19 09:18:58',
            ),
            1 => 
            array (
                'id' => '7',
                'code' => 'extra_income',
                'included' => '1',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-esodwn-2014',
                'created_at' => '2017-02-19 07:45:57',
                'updated_at' => '2017-02-19 07:45:57',
            ),
            2 => 
            array (
                'id' => '8',
                'code' => 'total_regular_income',
                'included' => '0,211,321,511',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-esodwn-2014',
                'created_at' => '2017-02-19 07:47:18',
                'updated_at' => '2017-02-19 07:47:18',
            ),
            3 => 
            array (
                'id' => '9',
                'code' => 'total_extra_income',
                'included' => '1,221,322,512',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-esodwn-2014',
                'created_at' => '2017-02-19 07:49:03',
                'updated_at' => '2017-02-19 07:49:03',
            ),
            4 => 
            array (
                'id' => '10',
                'code' => 'own_regular_income',
                'included' => '0,211,321,511',
                'excluded' => '06',
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-esodwn-2014',
                'created_at' => '2017-02-19 07:51:30',
                'updated_at' => '2017-02-19 07:56:27',
            ),
            5 => 
            array (
                'id' => '11',
                'code' => 'own_income',
                'included' => '0,1,2,3,5',
                'excluded' => '06,12,13,2212,31,3222',
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-esodwn-2014',
                'created_at' => '2017-02-19 07:55:58',
                'updated_at' => '2017-02-19 07:55:58',
            ),
            6 => 
            array (
                'id' => '12',
                'code' => 'contributary_income',
                'included' => '031,2111,3211',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-esodwn-2014',
                'created_at' => '2017-02-19 07:58:35',
                'updated_at' => '2017-02-19 07:58:35',
            ),
            7 => 
            array (
                'id' => '13',
                'code' => 'τaxes_fees',
                'included' => '051,031,0322,0342,2111,2112,2113,2114,3211,3212,3213,3214,04,2119,3219,0122,0715,0718,2115,2116,3215,3216,3218',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-esodwn-2014',
                'created_at' => '2017-02-19 08:02:38',
                'updated_at' => '2017-02-19 08:02:38',
            ),
            8 => 
            array (
                'id' => '14',
                'code' => 'total_subsidies',
                'included' => '06,12,13',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-esodwn-2014',
                'created_at' => '2017-02-19 08:05:07',
                'updated_at' => '2017-02-19 08:05:07',
            ),
            9 => 
            array (
                'id' => '15',
                'code' => 'total_income',
                'included' => '0,1,2,3,4,5',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-esodwn-2014',
                'created_at' => '2017-02-19 08:07:04',
                'updated_at' => '2017-02-19 08:07:04',
            ),
            10 => 
            array (
                'id' => '16',
                'code' => 'total_costs',
                'included' => '6,7,8,9',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-exodwn-2014',
                'created_at' => '2017-02-19 08:09:19',
                'updated_at' => '2017-02-19 08:09:19',
            ),
            11 => 
            array (
                'id' => '17',
                'code' => 'operating_costs',
                'included' => '6',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-exodwn-2014',
                'created_at' => '2017-02-19 08:13:27',
                'updated_at' => '2017-02-19 08:13:27',
            ),
            12 => 
            array (
                'id' => '18',
                'code' => 'total_investment',
                'included' => '7',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-exodwn-2014',
                'created_at' => '2017-02-19 08:15:05',
                'updated_at' => '2017-02-19 08:15:05',
            ),
            13 => 
            array (
                'id' => '19',
                'code' => 'past_depts',
                'included' => '81',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-exodwn-2014',
                'created_at' => '2017-02-19 08:18:15',
                'updated_at' => '2017-02-19 08:18:15',
            ),
            14 => 
            array (
                'id' => '20',
                'code' => 'receivable_balances',
                'included' => '32',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-esodwn-2014',
                'created_at' => '2017-02-19 08:20:18',
                'updated_at' => '2017-02-19 08:20:18',
            ),
            15 => 
            array (
                'id' => '21',
                'code' => 'employment_costs',
                'included' => '60',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-exodwn-2014',
                'created_at' => '2017-02-19 08:21:53',
                'updated_at' => '2017-02-19 08:21:53',
            ),
            16 => 
            array (
                'id' => '22',
                'code' => 'repayments',
                'included' => '65',
                'excluded' => NULL,
                'codelist' => 'http://data.openbudgets.eu/resource/codelist/kae-ota-exodwn-2014',
                'created_at' => '2017-02-19 08:23:14',
                'updated_at' => '2017-02-19 08:23:14',
            ),
            17 => 
            array (
                'id' => '23',
                'code' => 'population',
                'included' => 'http://dbpedia.org/ontology/populationTotal',
                'excluded' => NULL,
                'codelist' => 'http://el.dbpedia.org/sparql',
                'created_at' => '2017-02-19 08:25:56',
                'updated_at' => '2017-02-19 08:25:56',
            ),
        ));
        
        
    }
}