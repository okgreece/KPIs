<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AggregatorTranslationsTableSeeder::class);
        $this->call(AggregatorsTableSeeder::class);
        $this->call(GroupTranslationsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(IndicatorTranslationsTableSeeder::class);
        $this->call(IndicatorsTableSeeder::class);
        $this->call(RdfNamespacesTableSeeder::class);
        $this->call(CodelistCollectionsTableSeeder::class);
        $this->call(CodelistCollectionTranslationsTableSeeder::class);
    }
}
