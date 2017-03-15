<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('groups')->delete();
        
        \DB::table('groups')->insert(array (
            0 => 
            array (
                'id' => '10',
                'code' => 'perPeople',
                'created_at' => '2017-02-19 08:59:59',
                'updated_at' => '2017-02-19 08:59:59',
            ),
            1 => 
            array (
                'id' => '11',
                'code' => 'HR',
                'created_at' => '2017-02-19 09:01:58',
                'updated_at' => '2017-02-19 09:01:58',
            ),
            2 => 
            array (
                'id' => '12',
                'code' => 'correlation',
                'created_at' => '2017-02-19 09:03:33',
                'updated_at' => '2017-02-20 15:32:55',
            ),
            3 => 
            array (
                'id' => '13',
                'code' => 'structural',
                'created_at' => '2017-02-19 09:05:07',
                'updated_at' => '2017-02-20 15:35:15',
            ),
        ));
        
        
    }
}