<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OSEndpoint extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'o_s_endpoints';

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
    protected $fillable = ['uri', 'enabled'];

    
}
