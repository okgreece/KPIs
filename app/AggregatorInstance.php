<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AggregatorInstance extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aggregator_instances';

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
    protected $fillable = ['type', 'resource', 'aggregator_id', 'codelist'];

    public function aggregator(){
        return $this->belongsTo("\App\Aggregator", "aggregator_id", "id");
    }
    
    public function collection(){
        return $this->belongsTo("\App\CodelistCollection","resource");
    }
}
