<?php

use Illuminate\Database\Seeder;

class IndicatorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('indicators')->delete();
        
        \DB::table('indicators')->insert(array (
            0 => 
            array (
                'id' => '3',
                'indicator' => 'employment_to_expenses',
                'group' => '11',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '21',
                'denominator' => '16',
                'created_at' => '2017-02-19 09:13:36',
                'updated_at' => '2017-02-19 09:13:36',
                'reverse' => '1',
            ),
            1 => 
            array (
                'id' => '4',
                'indicator' => 'employment_operational_cost',
                'group' => '11',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '21',
                'denominator' => '17',
                'created_at' => '2017-02-19 09:26:00',
                'updated_at' => '2017-02-19 23:58:28',
                'reverse' => '1',
            ),
            2 => 
            array (
                'id' => '5',
                'indicator' => 'income_per_population',
                'group' => '10',
                'enabled' => '1',
                'type' => '1',
                'numerator' => '15',
                'denominator' => '23',
                'created_at' => '2017-02-19 16:27:14',
                'updated_at' => '2017-02-19 16:27:14',
                'reverse' => '0',
            ),
            3 => 
            array (
                'id' => '6',
                'indicator' => 'expenses_per_citizen',
                'group' => '10',
                'enabled' => '1',
                'type' => '1',
                'numerator' => '16',
                'denominator' => '23',
                'created_at' => '2017-02-19 19:24:50',
                'updated_at' => '2017-02-19 19:24:50',
                'reverse' => '0',
            ),
            4 => 
            array (
                'id' => '7',
                'indicator' => 'taxation_indicator',
                'group' => '10',
                'enabled' => '1',
                'type' => '1',
                'numerator' => '11',
                'denominator' => '23',
                'created_at' => '2017-02-19 19:31:19',
                'updated_at' => '2017-02-19 19:31:19',
                'reverse' => '0',
            ),
            5 => 
            array (
                'id' => '8',
                'indicator' => 'retributive_tax',
                'group' => '10',
                'enabled' => '1',
                'type' => '1',
                'numerator' => '12',
                'denominator' => '23',
                'created_at' => '2017-02-19 19:34:49',
                'updated_at' => '2017-02-19 19:34:49',
                'reverse' => '1',
            ),
            6 => 
            array (
                'id' => '9',
                'indicator' => 'taxes_resident',
                'group' => '10',
                'enabled' => '1',
                'type' => '1',
                'numerator' => '13',
                'denominator' => '23',
                'created_at' => '2017-02-19 19:37:00',
                'updated_at' => '2017-02-19 19:37:00',
                'reverse' => '1',
            ),
            7 => 
            array (
                'id' => '10',
                'indicator' => 'operetional_resident',
                'group' => '10',
                'enabled' => '1',
                'type' => '1',
                'numerator' => '17',
                'denominator' => '23',
                'created_at' => '2017-02-19 19:39:44',
                'updated_at' => '2017-02-19 19:39:44',
                'reverse' => '1',
            ),
            8 => 
            array (
                'id' => '11',
                'indicator' => 'investments_resident',
                'group' => '10',
                'enabled' => '1',
                'type' => '1',
                'numerator' => '18',
                'denominator' => '23',
                'created_at' => '2017-02-19 20:39:20',
                'updated_at' => '2017-02-19 20:39:20',
                'reverse' => '0',
            ),
            9 => 
            array (
                'id' => '12',
                'indicator' => 'subsidies_resident',
                'group' => '10',
                'enabled' => '1',
                'type' => '1',
                'numerator' => '14',
                'denominator' => '23',
                'created_at' => '2017-02-19 20:42:49',
                'updated_at' => '2017-02-19 20:42:49',
                'reverse' => '0',
            ),
            10 => 
            array (
                'id' => '13',
                'indicator' => 'subsidies_expenses',
                'group' => '12',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '14',
                'denominator' => '16',
                'created_at' => '2017-02-19 20:46:55',
                'updated_at' => '2017-02-19 20:51:12',
                'reverse' => '1',
            ),
            11 => 
            array (
                'id' => '14',
                'indicator' => 'operational_regular_income',
                'group' => '12',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '17',
                'denominator' => '6',
                'created_at' => '2017-02-19 20:50:55',
                'updated_at' => '2017-02-19 20:50:55',
                'reverse' => '1',
            ),
            12 => 
            array (
                'id' => '15',
                'indicator' => 'employment_regular_income',
                'group' => '12',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '21',
                'denominator' => '6',
                'created_at' => '2017-02-19 20:54:53',
                'updated_at' => '2017-02-19 23:59:27',
                'reverse' => '1',
            ),
            13 => 
            array (
                'id' => '16',
                'indicator' => 'autonomy',
                'group' => '13',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '8',
                'denominator' => '15',
                'created_at' => '2017-02-19 22:39:20',
                'updated_at' => '2017-02-19 22:39:20',
                'reverse' => '0',
            ),
            14 => 
            array (
                'id' => '17',
                'indicator' => 'instability',
                'group' => '13',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '9',
                'denominator' => '15',
                'created_at' => '2017-02-19 22:41:00',
                'updated_at' => '2017-02-19 22:41:00',
                'reverse' => '1',
            ),
            15 => 
            array (
                'id' => '18',
                'indicator' => 'dependece',
                'group' => '13',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '14',
                'denominator' => '15',
                'created_at' => '2017-02-19 22:45:28',
                'updated_at' => '2017-02-19 22:45:28',
                'reverse' => '1',
            ),
            16 => 
            array (
                'id' => '19',
                'indicator' => 'Independence',
                'group' => '13',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '11',
                'denominator' => '15',
                'created_at' => '2017-02-19 22:47:16',
                'updated_at' => '2017-02-19 22:47:16',
                'reverse' => '0',
            ),
            17 => 
            array (
                'id' => '20',
                'indicator' => 'operational_autonomy',
                'group' => '13',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '10',
                'denominator' => '8',
                'created_at' => '2017-02-19 22:49:12',
                'updated_at' => '2017-02-19 22:49:12',
                'reverse' => '0',
            ),
            18 => 
            array (
                'id' => '21',
                'indicator' => 'operational_expenses',
                'group' => '13',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '17',
                'denominator' => '16',
                'created_at' => '2017-02-19 22:56:27',
                'updated_at' => '2017-02-19 22:56:27',
                'reverse' => '1',
            ),
            19 => 
            array (
                'id' => '22',
                'indicator' => 'Investments',
                'group' => '13',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '18',
                'denominator' => '16',
                'created_at' => '2017-02-19 22:59:56',
                'updated_at' => '2017-02-19 22:59:56',
                'reverse' => '0',
            ),
            20 => 
            array (
                'id' => '23',
                'indicator' => 'obligations',
                'group' => '13',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '19',
                'denominator' => '16',
                'created_at' => '2017-02-19 23:01:50',
                'updated_at' => '2017-02-19 23:01:50',
                'reverse' => '1',
            ),
            21 => 
            array (
                'id' => '24',
                'indicator' => 'receivable',
                'group' => '13',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '20',
                'denominator' => '15',
                'created_at' => '2017-02-19 23:05:55',
                'updated_at' => '2017-02-19 23:57:13',
                'reverse' => '1',
            ),
            22 => 
            array (
                'id' => '25',
                'indicator' => 'settlement',
                'group' => '13',
                'enabled' => '1',
                'type' => '0',
                'numerator' => '22',
                'denominator' => '8',
                'created_at' => '2017-02-19 23:10:14',
                'updated_at' => '2017-02-19 23:10:14',
                'reverse' => '1',
            ),
        ));
        
        
    }
}