<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aggregator extends Model 
{

    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['title', 'description'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aggregators';

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
    protected $fillable = ['code', 'included', 'excluded', 'codelist'];
    
    public function indicators(){
        return $this->belongsToMany("Indicator");
    }
}
