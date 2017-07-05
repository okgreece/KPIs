<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeonamesInstance extends Model
{
    
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['label'];
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'geonames_instances';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['geonames_id', 'level', 'adm1', 'adm2', 'adm3', 'adm4', 'continent', 'country', 'population', 'long', 'lat', 'dbpedia', 'wikipedia', 'map', 'ppl'];
    
    
    public function label(){
        
    }
    
    public function adminLevel(){
        
    }
    
    public function population(){
        
    }
    
    public function parentFeature(){
        
    }
    
    public function geo(){
        
    }
    
    public function contains(){
        
    }
            
}
