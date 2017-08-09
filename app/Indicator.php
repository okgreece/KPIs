<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['title', 'description'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'indicators';

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
    protected $fillable = ['indicator', 'group', 'enabled', 'type', 'numerator', 'denominator', 'reverse'];

    public function num(){
        return $this->hasOne("\App\Aggregator", "id", "numerator");
    }
    
    public function denom(){
        return $this->hasOne("\App\Aggregator", "id", "denominator");
    }
    
    public function indicatorGroup(){
        return $this->belongsTo("App\Group", "group", "id");
    }
    
    public function type(){
        $types = [            
            "percent",
            "numeric",
            "barchart"
        ];
        return $types[$this->type];
    }
    
    public function reverse(){
        return $this->reverse ? TRUE : FALSE;
    }
    
}
