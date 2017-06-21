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
    protected $fillable = ['type', 'resource', 'aggregator_id'];

    public function aggregator(){
        return $this->hasOne("\App\Aggregator", "id", "aggregator_id");
    }
}
