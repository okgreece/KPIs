<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodelistCollection extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['title', 'description'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'codelist_collections';

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
    protected $fillable = ['codelist', 'included', 'excluded'];

    public function instance(){
        return $this->belongsTo("\App\AggregatorInstance", "resource");
    }
    
    public function codelist(){
        $resource = new \EasyRdf_Namespace();
        
        return $resource->shorten($this->codelist, true);
    }
}
