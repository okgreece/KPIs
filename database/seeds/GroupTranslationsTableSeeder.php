<?php

use Illuminate\Database\Seeder;

class GroupTranslationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('group_translations')->delete();
        
        \DB::table('group_translations')->insert(array (
            0 => 
            array (
                'id' => '4',
                'group_id' => '7',
                'title' => 'Group1 title en',
                'description' => 'Group1 description en',
                'locale' => 'en',
            ),
            1 => 
            array (
                'id' => '5',
                'group_id' => '7',
                'title' => 'Group1 title el',
                'description' => 'Group1 description el',
                'locale' => 'el',
            ),
            2 => 
            array (
                'id' => '6',
                'group_id' => '8',
                'title' => 'Group1 title en',
                'description' => 'Group1 description en',
                'locale' => 'en',
            ),
            3 => 
            array (
                'id' => '7',
                'group_id' => '8',
                'title' => 'Group1 title el',
                'description' => 'Group1 description el2',
                'locale' => 'el',
            ),
            4 => 
            array (
                'id' => '8',
                'group_id' => '9',
                'title' => 'Group1 title en',
                'description' => 'Group1 description en',
                'locale' => 'en',
            ),
            5 => 
            array (
                'id' => '9',
                'group_id' => '9',
                'title' => 'Group1 title el',
                'description' => 'Group1 description el',
                'locale' => 'el',
            ),
            6 => 
            array (
                'id' => '10',
                'group_id' => '10',
                'title' => 'Per Population Income/Expense Indicators',
                'description' => 'Per Population Income/Expense Indicators',
                'locale' => 'en',
            ),
            7 => 
            array (
                'id' => '11',
                'group_id' => '10',
                'title' => 'Δείκτες Εσόδων/Εξόδων ανά Κάτοικο',
                'description' => 'Δείκτες Εσόδων/Εξόδων ανά Κάτοικο',
                'locale' => 'el',
            ),
            8 => 
            array (
                'id' => '12',
                'group_id' => '11',
                'title' => 'Human Resources Indicators',
                'description' => 'Human Resources Indicators',
                'locale' => 'en',
            ),
            9 => 
            array (
                'id' => '13',
                'group_id' => '11',
                'title' => 'Δείκτες Ανθρωπίνου Δυναμικού',
                'description' => 'Δείκτες Ανθρωπίνου Δυναμικού',
                'locale' => 'el',
            ),
            10 => 
            array (
                'id' => '14',
                'group_id' => '12',
                'title' => 'Correlation of Income - Expenses Indicators',
                'description' => 'Correlation of Income - Expenses Indicators',
                'locale' => 'en',
            ),
            11 => 
            array (
                'id' => '15',
                'group_id' => '12',
                'title' => 'Δείκτες Συσχέτισης Εσόδων - Εξόδων',
                'description' => 'Δείκτες Συσχέτισης Εσόδων - Εξόδων',
                'locale' => 'el',
            ),
            12 => 
            array (
                'id' => '16',
                'group_id' => '13',
                'title' => 'Structural Indicators',
                'description' => 'Structural Indicators',
                'locale' => 'en',
            ),
            13 => 
            array (
                'id' => '17',
                'group_id' => '13',
                'title' => 'Δείκτες Δομής',
                'description' => 'Δείκτες Δομής',
                'locale' => 'el',
            ),
        ));
        
        
    }
}