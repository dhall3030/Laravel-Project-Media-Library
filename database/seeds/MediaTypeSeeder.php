<?php

use Illuminate\Database\Seeder;
use App\Media_Type;

class MediaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $media_type = new Media_Type();
    	 $media_type->name ="CD";
    	 $media_type->save();

    	 $media_type = new Media_Type();
    	 $media_type->name ="DVD";
    	 $media_type->save();

    	 $media_type = new Media_Type();
    	 $media_type->name ="Blue-Ray";
    	 $media_type->save();

         $media_type = new Media_Type();
         $media_type->name ="PS3";
         $media_type->save();

         $media_type = new Media_Type();
         $media_type->name ="PS4";
         $media_type->save();
    }
}
