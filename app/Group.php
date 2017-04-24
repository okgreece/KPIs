<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use \Dimsav\Translatable\Translatable;
    
    public $translatedAttributes = ['title', 'description'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';

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
        return $this->hasMany("App\Indicator", "id", "group");
    }
}
