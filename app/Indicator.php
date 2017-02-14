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
    protected $fillable = ['indicator', 'group', 'enabled', 'type', 'nominator', 'denominator'];

    public function nom(){
        return $this->hasOne("\App\Aggregator", "id", "nominator");
    }
    
    public function denom(){
        return $this->hasOne("Aggregator", "id", "denominator");
    }
}
