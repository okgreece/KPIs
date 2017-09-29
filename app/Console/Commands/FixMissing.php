<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FixMissing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kpi:fixMissing '
            . '{--model= : define model to check otherwise it will check all models}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixes missing relationships in database. ATTENTION!It will delete all eroneous models.';

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
        $models = explode(',', $this->option("model"));
        foreach($models as $model){
            $this->info("Fixing Model " . $model);
            try{
                $this->$model();
            } catch (\Exception $ex) {
                $this->error("Model class not found " . $ex);
            }            
        }        
    }
    
    public function AggregatorInstance(){
        $instances = \App\AggregatorInstance::all();
        foreach($instances as $instance){
            $this->info("---------------------------------------");
            $this->info("Checking model:" . $instance->id);
            if (!isset($instance->collection)){
                $this->info("Found missing relationship on model:");
                try{
                    $instance->delete();
                } catch (\Exception $ex) {
                    $this->info($ex);
                }
            }
            else{
                $this->info("Model is correct");
            }
        }
    }
}
