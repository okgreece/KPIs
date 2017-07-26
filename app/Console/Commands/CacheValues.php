<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CacheValues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kpi:cacheValues';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate all values for all indicators defined for all organizations included';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "Caching Values\n";
        $organizations = \App\Organization::all();
        $bar = $this->output->createProgressBar(count($organizations));
        
        foreach($organizations as $organization){
            $this->line($organization->geonamesInstance->label);
            $this->calculateValues($organization);
            $bar->advance();
            $this->line("");
        }
        
    }
    public function calculateValues(\App\Organization $organization){
        
        
        $indicators = \App\Indicator::all();
        $bar =$this->output->createProgressBar(count($indicators));
        $client = new \GuzzleHttp\Client();
        foreach($indicators as $indicator){
            try{
                $res = $client->get("http://kpi.okfn.gr/api/v1/indicators/" . $indicator->indicator. "/value", ["query" => ["organization" => $organization->uri]]);
                $bar->advance();
            } catch (\Exception $ex) {
                //$this->line(var_dump($ex));
                $bar->advance();
            }
        }
        $bar->finish();
        
    }
    
    
}
