<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media_Type extends Model
{
    protected $table = 'media_types';

    public $primaryKey ='media_type_id';



    public function media()
	{
    return $this->hasMany('App\Media','media_type_id', 'media_type_id');
	}
}
