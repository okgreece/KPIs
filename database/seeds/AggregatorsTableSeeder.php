<?php

use Illuminate\Database\Seeder;

class AggregatorsTableSeeder extends Seeder
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
                'created_at' => '2017-02-19 07:43:13',
                'updated_at' => '2017-02-19 09:18:58',
            ),
            1 => 
            array (
                'id' => '7',
                'code' => 'extra_income',
                'created_at' => '2017-02-19 07:45:57',
                'updated_at' => '2017-02-19 07:45:57',
            ),
            2 => 
            array (
                'id' => '8',
                'code' => 'total_regular_income',
                'created_at' => '2017-02-19 07:47:18',
                'updated_at' => '2017-02-19 07:47:18',
            ),
            3 => 
            array (
                'id' => '9',
                'code' => 'total_extra_income',
                'created_at' => '2017-02-19 07:49:03',
                'updated_at' => '2017-02-19 07:49:03',
            ),
            4 => 
            array (
                'id' => '10',
                'code' => 'own_regular_income',
                'created_at' => '2017-02-19 07:51:30',
                'updated_at' => '2017-02-19 07:56:27',
            ),
            5 => 
            array (
                'id' => '11',
                'code' => 'own_income',
                'created_at' => '2017-02-19 07:55:58',
                'updated_at' => '2017-02-19 07:55:58',
            ),
            6 => 
            array (
                'id' => '12',
                'code' => 'contributary_income',
                'created_at' => '2017-02-19 07:58:35',
                'updated_at' => '2017-02-19 07:58:35',
            ),
            7 => 
            array (
                'id' => '13',
                'code' => 'τaxes_fees',
                'created_at' => '2017-02-19 08:02:38',
                'updated_at' => '2017-02-19 08:02:38',
            ),
            8 => 
            array (
                'id' => '14',
                'code' => 'total_subsidies',
                'created_at' => '2017-02-19 08:05:07',
                'updated_at' => '2017-02-19 08:05:07',
            ),
            9 => 
            array (
                'id' => '15',
                'code' => 'total_income',
                'created_at' => '2017-02-19 08:07:04',
                'updated_at' => '2017-02-19 08:07:04',
            ),
            10 => 
            array (
                'id' => '16',
                'code' => 'total_costs',
                'created_at' => '2017-02-19 08:09:19',
                'updated_at' => '2017-02-19 08:09:19',
            ),
            11 => 
            array (
                'id' => '17',
                'code' => 'operating_costs',
                'created_at' => '2017-02-19 08:13:27',
                'updated_at' => '2017-02-19 08:13:27',
            ),
            12 => 
            array (
                'id' => '18',
                'code' => 'total_investment',
                'created_at' => '2017-02-19 08:15:05',
                'updated_at' => '2017-02-19 08:15:05',
            ),
            13 => 
            array (
                'id' => '19',
                'code' => 'past_depts',
                'created_at' => '2017-02-19 08:18:15',
                'updated_at' => '2017-02-19 08:18:15',
            ),
            14 => 
            array (
                'id' => '20',
                'code' => 'receivable_balances',
                'created_at' => '2017-02-19 08:20:18',
                'updated_at' => '2017-02-19 08:20:18',
            ),
            15 => 
            array (
                'id' => '21',
                'code' => 'employment_costs',
                'created_at' => '2017-02-19 08:21:53',
                'updated_at' => '2017-02-19 08:21:53',
            ),
            16 => 
            array (
                'id' => '22',
                'code' => 'repayments',
                'created_at' => '2017-02-19 08:23:14',
                'updated_at' => '2017-02-19 08:23:14',
            ),
            17 => 
            array (
                'id' => '23',
                'code' => 'population',
                'created_at' => '2017-02-19 08:25:56',
                'updated_at' => '2017-02-19 08:25:56',
            ),
        ));
        
        
    }
}