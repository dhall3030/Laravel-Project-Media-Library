<?php

namespace App\Http\Controllers;

use App\User;
use App\Media;
use App\Media_Image;
use Input;
use App\Utilities\ImageManipulator;
use App\Utilities\ResizeImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;




/**
     * Loads multiple upload view. upload files and create database records 
     *
     * @param  int  $id
     * @return Response
     */




class UploadController extends Controller
{

	public function uploadMultiple($id)
    {

    	if(Input::exists('Go')===true)
    	{

    		$date = date('Y-m-d H:i:s');


    		$files = Input::file('image');

           

            foreach($files as $file) {

	            $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
	      		$validator = Validator::make(array('file'=> $file), $rules); 

	      		if($validator->passes()){	


	            echo $file->getClientOriginalName()."<br>";

	            $imageName =   md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();

	            $file->move(base_path() . '/public/media_images/', $imageName);

	            $folder ='media_images';

                ResizeImage::processImage($imageName , $folder);

	        	

                 $image = new Media_Image;
                 $image->image = $imageName;
                 $image->media_id = $id;
                 $image->priority = 0;
                 $image->save();





                }


            }

            return Redirect::to('/update-media/'.$id)->withFlashMessage('Image uploaded Successfully.');

        }

    }

}




