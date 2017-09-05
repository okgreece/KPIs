<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organizations';

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
    protected $fillable = ['uri', 'enabled', 'geonames_instance_id', 'dimension'];
    
    public function geonamesInstance(){
        return $this->belongsTo("\App\GeonamesInstance");
    }

    
}
