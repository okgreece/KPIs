<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeonamesInstanceTranslation extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'geonames_instances_translations';

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
    protected $fillable = ['label', 'locale'];
}
