<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SPARQLEndpoint extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 's_p_a_r_q_l_endpoints';

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
