<?php

use Illuminate\Database\Seeder;

class AggregatorTranslationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('aggregator_translations')->delete();
        
        \DB::table('aggregator_translations')->insert(array (
            0 => 
            array (
                'id' => '1',
                'aggregator_id' => '2',
                'title' => 'Regular Revenue',
                'description' => 'Regular Revenue',
                'locale' => 'en',
            ),
            1 => 
            array (
                'id' => '2',
                'aggregator_id' => '2',
                'title' => 'Τακτικά Έσοδα',
                'description' => 'Τακτικά έσοδα προϋπολογισμού',
                'locale' => 'el',
            ),
            2 => 
            array (
                'id' => '3',
                'aggregator_id' => '3',
                'title' => 'Regular Revenue',
                'description' => 'Regular Revenue',
                'locale' => 'en',
            ),
            3 => 
            array (
                'id' => '4',
                'aggregator_id' => '3',
                'title' => 'Τακτικά Έσοδα',
                'description' => 'Τακτικά έσοδα προϋπολογισμού',
                'locale' => 'el',
            ),
            4 => 
            array (
                'id' => '5',
                'aggregator_id' => '4',
                'title' => 'Regular Revenue',
                'description' => 'Regular Revenue',
                'locale' => 'en',
            ),
            5 => 
            array (
                'id' => '6',
                'aggregator_id' => '4',
                'title' => 'Τακτικά Έσοδα',
                'description' => 'Τακτικά έσοδα προϋπολογισμού',
                'locale' => 'el',
            ),
            6 => 
            array (
                'id' => '7',
                'aggregator_id' => '5',
                'title' => 'Regular Revenue',
                'description' => 'Regular Revenue',
                'locale' => 'en',
            ),
            7 => 
            array (
                'id' => '8',
                'aggregator_id' => '5',
                'title' => 'Τακτικά Έσοδα2',
                'description' => 'Τακτικά έσοδα προϋπολογισμού2',
                'locale' => 'el',
            ),
            8 => 
            array (
                'id' => '9',
                'aggregator_id' => '6',
                'title' => 'Regular Income',
                'description' => 'Regula Income',
                'locale' => 'en',
            ),
            9 => 
            array (
                'id' => '10',
                'aggregator_id' => '6',
                'title' => 'Τακτικά Έσοδα',
                'description' => 'Τακτικά έσοδα',
                'locale' => 'el',
            ),
            10 => 
            array (
                'id' => '11',
                'aggregator_id' => '7',
                'title' => 'Extraoordinary Income',
                'description' => 'Extraoordinary Income',
                'locale' => 'en',
            ),
            11 => 
            array (
                'id' => '12',
                'aggregator_id' => '7',
                'title' => 'Έκτακτα Έσοδα',
                'description' => 'Έκτακτα Έσοδα',
                'locale' => 'el',
            ),
            12 => 
            array (
                'id' => '13',
                'aggregator_id' => '8',
                'title' => 'Total Regular Income',
                'description' => 'Total Regular Income',
                'locale' => 'en',
            ),
            13 => 
            array (
                'id' => '14',
                'aggregator_id' => '8',
                'title' => 'Σύνολο Τακτικών Εσόδων',
                'description' => 'Σύνολο Τακτικών Εσόδων',
                'locale' => 'el',
            ),
            14 => 
            array (
                'id' => '15',
                'aggregator_id' => '9',
                'title' => 'Total Extraordinary Income',
                'description' => 'Total Extraordinary Income',
                'locale' => 'en',
            ),
            15 => 
            array (
                'id' => '16',
                'aggregator_id' => '9',
                'title' => 'Σύνολο Έκτακτων Εσόδων',
                'description' => 'Σύνολο Έκτακτων Εσόδων',
                'locale' => 'el',
            ),
            16 => 
            array (
                'id' => '17',
                'aggregator_id' => '10',
                'title' => 'Own Regular Income',
                'description' => 'Own Regular Income',
                'locale' => 'en',
            ),
            17 => 
            array (
                'id' => '18',
                'aggregator_id' => '10',
                'title' => 'Ίδια Τακτικά Έσοδα',
                'description' => 'Ίδια Τακτικά Έσοδα',
                'locale' => 'el',
            ),
            18 => 
            array (
                'id' => '19',
                'aggregator_id' => '11',
                'title' => 'Own Income',
                'description' => 'Own Income',
                'locale' => 'en',
            ),
            19 => 
            array (
                'id' => '20',
                'aggregator_id' => '11',
                'title' => 'Ίδια Έσοδα',
                'description' => 'Ίδια Έσοδα',
                'locale' => 'el',
            ),
            20 => 
            array (
                'id' => '21',
                'aggregator_id' => '12',
                'title' => 'Contributary Income',
                'description' => 'Contributary Income',
                'locale' => 'en',
            ),
            21 => 
            array (
                'id' => '22',
                'aggregator_id' => '12',
                'title' => 'Ανταποδοτικά Έσοδα',
                'description' => 'Ανταποδοτικά Έσοδα',
                'locale' => 'el',
            ),
            22 => 
            array (
                'id' => '23',
                'aggregator_id' => '13',
                'title' => 'Taxes and fees',
                'description' => 'Taxes and fees',
                'locale' => 'en',
            ),
            23 => 
            array (
                'id' => '24',
                'aggregator_id' => '13',
                'title' => 'Φόροι και Τέλη',
                'description' => 'Φόροι και Τέλη',
                'locale' => 'el',
            ),
            24 => 
            array (
                'id' => '25',
                'aggregator_id' => '14',
                'title' => 'Total Subsidies',
                'description' => 'Total Subsidies',
                'locale' => 'en',
            ),
            25 => 
            array (
                'id' => '26',
                'aggregator_id' => '14',
                'title' => 'Σύνολο Επιχορηγήσεων',
                'description' => 'Σύνολο Επιχορηγήσεων',
                'locale' => 'el',
            ),
            26 => 
            array (
                'id' => '27',
                'aggregator_id' => '15',
                'title' => 'Total Income',
                'description' => 'Total Income',
                'locale' => 'en',
            ),
            27 => 
            array (
                'id' => '28',
                'aggregator_id' => '15',
                'title' => 'Συνολικά Έσοδα',
                'description' => 'Συνολικά Έσοδα',
                'locale' => 'el',
            ),
            28 => 
            array (
                'id' => '29',
                'aggregator_id' => '16',
                'title' => 'Total Costs',
                'description' => 'Total Costs',
                'locale' => 'en',
            ),
            29 => 
            array (
                'id' => '30',
                'aggregator_id' => '16',
                'title' => 'Συνολικά Έξοδα',
                'description' => 'Συνολικά Έξοδα',
                'locale' => 'el',
            ),
            30 => 
            array (
                'id' => '31',
                'aggregator_id' => '17',
                'title' => 'Operating Costs',
                'description' => 'Operating Costs',
                'locale' => 'en',
            ),
            31 => 
            array (
                'id' => '32',
                'aggregator_id' => '17',
                'title' => 'Λειτουργικές Δαπάνες',
                'description' => 'Λειτουργικές Δαπάνες',
                'locale' => 'el',
            ),
            32 => 
            array (
                'id' => '33',
                'aggregator_id' => '18',
                'title' => 'Total Investment',
                'description' => 'Total Investment',
                'locale' => 'en',
            ),
            33 => 
            array (
                'id' => '34',
                'aggregator_id' => '18',
                'title' => 'Συνολικό Ποσό Επενδύσεων',
                'description' => 'Συνολικό Ποσό Επενδύσεων',
                'locale' => 'el',
            ),
            34 => 
            array (
                'id' => '35',
                'aggregator_id' => '19',
                'title' => 'Past Years Depts',
                'description' => 'Past Years Depts',
                'locale' => 'en',
            ),
            35 => 
            array (
                'id' => '36',
                'aggregator_id' => '19',
            'title' => 'Οφειλές Παρελθόντων Ετών (ΠΟΕ)',
            'description' => 'Οφειλές Παρελθόντων Ετών (ΠΟΕ)',
                'locale' => 'el',
            ),
            36 => 
            array (
                'id' => '37',
                'aggregator_id' => '20',
                'title' => 'Receivable Balances',
                'description' => 'Receivable Balances',
                'locale' => 'en',
            ),
            37 => 
            array (
                'id' => '38',
                'aggregator_id' => '20',
                'title' => 'Εισπρακτέα Υπόλοιπα',
                'description' => 'Εισπρακτέα Υπόλοιπα',
                'locale' => 'el',
            ),
            38 => 
            array (
                'id' => '39',
                'aggregator_id' => '21',
                'title' => 'Employment Costs',
                'description' => 'Employment Costs',
                'locale' => 'en',
            ),
            39 => 
            array (
                'id' => '40',
                'aggregator_id' => '21',
                'title' => 'Κόστος Απασχόλησης',
                'description' => 'Κόστος Απασχόλησης',
                'locale' => 'el',
            ),
            40 => 
            array (
                'id' => '41',
                'aggregator_id' => '22',
                'title' => 'Repayments',
                'description' => 'Repayments',
                'locale' => 'en',
            ),
            41 => 
            array (
                'id' => '42',
                'aggregator_id' => '22',
                'title' => 'Τοκοχρεολύσια',
                'description' => 'Τοκοχρεολύσια',
                'locale' => 'el',
            ),
            42 => 
            array (
                'id' => '43',
                'aggregator_id' => '23',
                'title' => 'Population',
                'description' => 'Population',
                'locale' => 'en',
            ),
            43 => 
            array (
                'id' => '44',
                'aggregator_id' => '23',
                'title' => 'Πληθυσμός',
                'description' => 'Πληθυσμός',
                'locale' => 'el',
            ),
        ));
        
        
    }
}