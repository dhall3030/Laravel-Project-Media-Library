<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media_Image extends Model
{
   protected $table = 'media_images';

   public $primaryKey ='media_image_id';



   public function media()
    {
        return $this->belongsTo('App\Media','media_id', 'media_id');
    }
}
