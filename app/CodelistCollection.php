<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodelistCollection extends Model
{
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

    
}
