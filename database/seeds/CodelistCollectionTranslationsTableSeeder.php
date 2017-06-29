<?php

use Illuminate\Database\Seeder;

class CodelistCollectionTranslationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('codelist_collections_translations')->delete();
        
        \DB::table('codelist_collections_translations')->insert(array (
            0 => 
            array (
                'id' => '1',
                'codelist_collection_id' => '2',
                'title' => 'Regular Revenue',
                'description' => 'Regular Revenue',
                'locale' => 'en',
            ),
            1 => 
            array (
                'id' => '2',
                'codelist_collection_id' => '2',
                'title' => 'Τακτικά Έσοδα',
                'description' => 'Τακτικά έσοδα προϋπολογισμού',
                'locale' => 'el',
            ),
            2 => 
            array (
                'id' => '3',
                'codelist_collection_id' => '3',
                'title' => 'Regular Revenue',
                'description' => 'Regular Revenue',
                'locale' => 'en',
            ),
            3 => 
            array (
                'id' => '4',
                'codelist_collection_id' => '3',
                'title' => 'Τακτικά Έσοδα',
                'description' => 'Τακτικά έσοδα προϋπολογισμού',
                'locale' => 'el',
            ),
            4 => 
            array (
                'id' => '5',
                'codelist_collection_id' => '4',
                'title' => 'Regular Revenue',
                'description' => 'Regular Revenue',
                'locale' => 'en',
            ),
            5 => 
            array (
                'id' => '6',
                'codelist_collection_id' => '4',
                'title' => 'Τακτικά Έσοδα',
                'description' => 'Τακτικά έσοδα προϋπολογισμού',
                'locale' => 'el',
            ),
            6 => 
            array (
                'id' => '7',
                'codelist_collection_id' => '5',
                'title' => 'Regular Revenue',
                'description' => 'Regular Revenue',
                'locale' => 'en',
            ),
            7 => 
            array (
                'id' => '8',
                'codelist_collection_id' => '5',
                'title' => 'Τακτικά Έσοδα2',
                'description' => 'Τακτικά έσοδα προϋπολογισμού2',
                'locale' => 'el',
            ),
            8 => 
            array (
                'id' => '9',
                'codelist_collection_id' => '6',
                'title' => 'Regular Income',
                'description' => 'Regula Income',
                'locale' => 'en',
            ),
            9 => 
            array (
                'id' => '10',
                'codelist_collection_id' => '6',
                'title' => 'Τακτικά Έσοδα',
                'description' => 'Τακτικά έσοδα',
                'locale' => 'el',
            ),
            10 => 
            array (
                'id' => '11',
                'codelist_collection_id' => '7',
                'title' => 'Extraoordinary Income',
                'description' => 'Extraoordinary Income',
                'locale' => 'en',
            ),
            11 => 
            array (
                'id' => '12',
                'codelist_collection_id' => '7',
                'title' => 'Έκτακτα Έσοδα',
                'description' => 'Έκτακτα Έσοδα',
                'locale' => 'el',
            ),
            12 => 
            array (
                'id' => '13',
                'codelist_collection_id' => '8',
                'title' => 'Total Regular Income',
                'description' => 'Total Regular Income',
                'locale' => 'en',
            ),
            13 => 
            array (
                'id' => '14',
                'codelist_collection_id' => '8',
                'title' => 'Σύνολο Τακτικών Εσόδων',
                'description' => 'Σύνολο Τακτικών Εσόδων',
                'locale' => 'el',
            ),
            14 => 
            array (
                'id' => '15',
                'codelist_collection_id' => '9',
                'title' => 'Total Extraordinary Income',
                'description' => 'Total Extraordinary Income',
                'locale' => 'en',
            ),
            15 => 
            array (
                'id' => '16',
                'codelist_collection_id' => '9',
                'title' => 'Σύνολο Έκτακτων Εσόδων',
                'description' => 'Σύνολο Έκτακτων Εσόδων',
                'locale' => 'el',
            ),
            16 => 
            array (
                'id' => '17',
                'codelist_collection_id' => '10',
                'title' => 'Own Regular Income',
                'description' => 'Own Regular Income',
                'locale' => 'en',
            ),
            17 => 
            array (
                'id' => '18',
                'codelist_collection_id' => '10',
                'title' => 'Ίδια Τακτικά Έσοδα',
                'description' => 'Ίδια Τακτικά Έσοδα',
                'locale' => 'el',
            ),
            18 => 
            array (
                'id' => '19',
                'codelist_collection_id' => '11',
                'title' => 'Own Income',
                'description' => 'Own Income',
                'locale' => 'en',
            ),
            19 => 
            array (
                'id' => '20',
                'codelist_collection_id' => '11',
                'title' => 'Ίδια Έσοδα',
                'description' => 'Ίδια Έσοδα',
                'locale' => 'el',
            ),
            20 => 
            array (
                'id' => '21',
                'codelist_collection_id' => '12',
                'title' => 'Contributary Income',
                'description' => 'Contributary Income',
                'locale' => 'en',
            ),
            21 => 
            array (
                'id' => '22',
                'codelist_collection_id' => '12',
                'title' => 'Ανταποδοτικά Έσοδα',
                'description' => 'Ανταποδοτικά Έσοδα',
                'locale' => 'el',
            ),
            22 => 
            array (
                'id' => '23',
                'codelist_collection_id' => '13',
                'title' => 'Taxes and fees',
                'description' => 'Taxes and fees',
                'locale' => 'en',
            ),
            23 => 
            array (
                'id' => '24',
                'codelist_collection_id' => '13',
                'title' => 'Φόροι και Τέλη',
                'description' => 'Φόροι και Τέλη',
                'locale' => 'el',
            ),
            24 => 
            array (
                'id' => '25',
                'codelist_collection_id' => '14',
                'title' => 'Total Subsidies',
                'description' => 'Total Subsidies',
                'locale' => 'en',
            ),
            25 => 
            array (
                'id' => '26',
                'codelist_collection_id' => '14',
                'title' => 'Σύνολο Επιχορηγήσεων',
                'description' => 'Σύνολο Επιχορηγήσεων',
                'locale' => 'el',
            ),
            26 => 
            array (
                'id' => '27',
                'codelist_collection_id' => '15',
                'title' => 'Total Income',
                'description' => 'Total Income',
                'locale' => 'en',
            ),
            27 => 
            array (
                'id' => '28',
                'codelist_collection_id' => '15',
                'title' => 'Συνολικά Έσοδα',
                'description' => 'Συνολικά Έσοδα',
                'locale' => 'el',
            ),
            28 => 
            array (
                'id' => '29',
                'codelist_collection_id' => '16',
                'title' => 'Total Costs',
                'description' => 'Total Costs',
                'locale' => 'en',
            ),
            29 => 
            array (
                'id' => '30',
                'codelist_collection_id' => '16',
                'title' => 'Συνολικά Έξοδα',
                'description' => 'Συνολικά Έξοδα',
                'locale' => 'el',
            ),
            30 => 
            array (
                'id' => '31',
                'codelist_collection_id' => '17',
                'title' => 'Operating Costs',
                'description' => 'Operating Costs',
                'locale' => 'en',
            ),
            31 => 
            array (
                'id' => '32',
                'codelist_collection_id' => '17',
                'title' => 'Λειτουργικές Δαπάνες',
                'description' => 'Λειτουργικές Δαπάνες',
                'locale' => 'el',
            ),
            32 => 
            array (
                'id' => '33',
                'codelist_collection_id' => '18',
                'title' => 'Total Investment',
                'description' => 'Total Investment',
                'locale' => 'en',
            ),
            33 => 
            array (
                'id' => '34',
                'codelist_collection_id' => '18',
                'title' => 'Συνολικό Ποσό Επενδύσεων',
                'description' => 'Συνολικό Ποσό Επενδύσεων',
                'locale' => 'el',
            ),
            34 => 
            array (
                'id' => '35',
                'codelist_collection_id' => '19',
                'title' => 'Past Years Depts',
                'description' => 'Past Years Depts',
                'locale' => 'en',
            ),
            35 => 
            array (
                'id' => '36',
                'codelist_collection_id' => '19',
            'title' => 'Οφειλές Παρελθόντων Ετών (ΠΟΕ)',
            'description' => 'Οφειλές Παρελθόντων Ετών (ΠΟΕ)',
                'locale' => 'el',
            ),
            36 => 
            array (
                'id' => '37',
                'codelist_collection_id' => '20',
                'title' => 'Receivable Balances',
                'description' => 'Receivable Balances',
                'locale' => 'en',
            ),
            37 => 
            array (
                'id' => '38',
                'codelist_collection_id' => '20',
                'title' => 'Εισπρακτέα Υπόλοιπα',
                'description' => 'Εισπρακτέα Υπόλοιπα',
                'locale' => 'el',
            ),
            38 => 
            array (
                'id' => '39',
                'codelist_collection_id' => '21',
                'title' => 'Employment Costs',
                'description' => 'Employment Costs',
                'locale' => 'en',
            ),
            39 => 
            array (
                'id' => '40',
                'codelist_collection_id' => '21',
                'title' => 'Κόστος Απασχόλησης',
                'description' => 'Κόστος Απασχόλησης',
                'locale' => 'el',
            ),
            40 => 
            array (
                'id' => '41',
                'codelist_collection_id' => '22',
                'title' => 'Repayments',
                'description' => 'Repayments',
                'locale' => 'en',
            ),
            41 => 
            array (
                'id' => '42',
                'codelist_collection_id' => '22',
                'title' => 'Τοκοχρεολύσια',
                'description' => 'Τοκοχρεολύσια',
                'locale' => 'el',
            ),
        ));
        
        
    }
}