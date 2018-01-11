<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use \App\Exceptions;

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
    protected $fillable = ['code'];
    
    public function indicators(){
        return $this->belongsToMany("Indicator");
    }
    
    public function instances(){
        return $this->hasMany('\App\AggregatorInstance');
    }
    
    public function collection(){
        $controller = new Http\Controllers\Admin\AggregatorsController;
        $attachment = $controller->getAttachement();
        $instance = $this->instances()->whereIn("codelist", explode('|||', implode('|||', $attachment->pluck("codelist")->toArray())))
            ->first();
        try {
            if($instance->type == 0){
               return $instance->resource;
            }// codelist SKOS Collection
            else if($instance->type == 1){
                return $instance->collection;
            }// local codelist collection
            else{
                throw new \Exception("This is not a collection.");
            }
        } catch (\Exception $ex) {
            dd($this, $attachment, $attachment->pluck("codelist")->toArray());
            $exception = new Exceptions\AggregatorInstanceNotFoundException("Aggregator Instance was not defined for this codelist");
            throw $exception;
        }
    }
}
