<?php
namespace App\Http\Controllers;

use App\User;
use App\Media;
use App\Media_Type;
use App\Media_Image;
use Input;
use File;
use App\Utilities\ImageManipulator;
use App\Utilities\ResizeImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;


class MediaLibController extends Controller
{

	

	/**
     * Get all media records.
     *
     * @return Response
     */



	public function getMedia()

	{

	
	//
	$media = Media::orderBy("name")->paginate(15);

	
	//search media
	$mediatypes = Media_Type::pluck('name', 'media_type_id');

	$value ="";

	$media_type_id = 1;

		if(Input::exists('Go')===true)
		
		{
			$value = Input::get('value');
			$media_type_id = Input::get('media_type_id');

			$media = Media::where('name', 'like', '%' . $value . '%')->where('media_type_id', $media_type_id )->orderBy("name")->paginate(15);

		}

		// reset results to show all
		if(Input::exists('Reset')===true)
		
		{
			$media = Media::orderBy("name")->paginate(15);
		}

	return view('media.media', ['media' => $media , 'media_type' => $mediatypes , 'media_type_id' => $media_type_id , 'value' => $value  ]);

	}

	
	

	/**
     * Get specific media record and load profile view.
     *
     * @param  int  $media_id
     * @return Response
     */


	public function getMediaProfile($media_id)

	{

		$media = Media::find($media_id);

		return view('media.profile', ['media' => $media ]);

	}




	/**
     * Load create media view. Create new record from form data 
     *
     * @return Response
     */


	public function createMedia()
	{
		if(Input::exists('Go')===true)
		{
			$rules = array('name' => 'required', 'description' => 'required', 'media_type_id' => 'required');
			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails()) {
			return Redirect::to('/create-media')
			->withErrors($validator) // send back all errors to the login form
			->withInput(); 
			} else {
			$name = Input::get('name');
			$number_of_copies = Input::get('number_of_copies');
			$description = Input::get('description');;
			$media_type_id = Input::get('media_type_id');
			$media = new Media;
			$media->name = $name;
			$media->description = $description;
			$media->media_type_id = $media_type_id;
			$media->save();
			return Redirect::to('/media/')->withFlashMessage('Media Item Created Successfully.');
			}
		}
		
		$mediatypes = Media_Type::pluck('name', 'media_type_id');

		return view('media.create', ['media_type' => $mediatypes ]);
	}


	
	/**
     * Load update media view. update media record from form data.
     *
     * @param  int  $media_id
     * @return Response
     */




	public function updateMedia($media_id)
	{

			$media = Media::find($media_id);
			if(Input::exists('Go')===true)
			{
				$rules = array('name' => 'required', 'description' => 'required', 'media_type_id' => 'required');
				$validator = Validator::make(Input::all(), $rules);
				if ($validator->fails()) {
				return Redirect::to('/update-media')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); 
				} else {
				$name = Input::get('name');
				$number_of_copies = Input::get('number_of_copies');
				$description = Input::get('description');
				$media_type_id = Input::get('media_type_id');
				$media->name = $name;
				$media->description = $description;
				$media->media_type_id = $media_type_id;
				$media->save();
				return Redirect::to('/media/')->withFlashMessage('Media Item Updated Successfully.');
				}
	    	}
			
			
	    	$mediatypes = Media_Type::pluck('name', 'media_type_id');


			return view('media.update', ['media' => $media , 'media_type' => $mediatypes ]);


	}



	
	/**
     * Delete specific media record. 
     *
     * @param  int  $media_id
     * @return Response
     */



	public function deleteMedia($media_id)
	{
		$deletedRows = Media::where('media_id', $media_id)->delete();
		return Redirect::to('/media/')->withFlashMessage('Item Deleted Successfully.');
	}



	

	/**
     * Load image uplaod view. Upload image from form and create database record 
     *
     * @param  int  $media_id
     * @return Response
     */




	public function uplaodImage($media_id)
    {


	    if(Input::exists('Go')===true)
            
        {


	       if (Input::file('image')->isValid()) { 


	       		$date = date('Y-m-d H:i:s');

				$imageName =   md5($date) . '.' . Input::file('image')->getClientOriginalExtension();

	            Input::file('image')->move(base_path() . '/public/media_images/', $imageName);

				$folder ='media_images';

                ResizeImage::processImage($imageName , $folder);


	             $image = new media_Image;
                 $image->image = $imageName;
                 $image->media_id = $media_id;
                 $image->priority = 0;
                 $image->save();


	       }

	   }
		return view('media.upload', ['media_id' => $media_id ]);

    }


    

    /**
     * Delete image database record and file.
     *
     * @param  int  $media_image_id
     * @return Response
     */



    public function deleteImage($media_image_id)
    {

    
	   

	    $image = Media_Image::find($media_image_id);

	    $imagePath = base_path() .'/public/media_images/image/'.$image->image;

	    $thumbPath = base_path() .'/public/media_images/thumb/'.$image->image;

	     
	    

	     //die($imagePath);
	    
		$deletedRows = Media_Image::where('media_image_id', $media_image_id)->delete();


	    File::delete($imagePath);

	    File::delete($thumbPath);


	    //die('It works!');
	    
	    return Redirect::to('/update-media/'.$image->media_id)->withFlashMessage('Image Deleted Successfully.');

    }


    /**
     * Updates image priority for sequntial ordering of images attached to a media record.
     *
     * @param  int  $media_image_id
     * @return Response
     */



    public function updateImage($media_image_id)
    {


    	$image = Media_Image::find($media_image_id);
			if(Input::exists('Go')===true)
			{
				$rules = array('priority' => 'required');
				$validator = Validator::make(Input::all(), $rules);
				if ($validator->fails()) {
				return Redirect::to('/update-image')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); 
				} else {
				
				$priority = Input::get('priority');
				$image->priority = $priority;
				$image->save();
				
				return Redirect::to('/update-media/'.$image->media->media_id)->withFlashMessage('Image Priority Updated Successfully.');
				
				}
	    	}

	    	return view('image.update', ['image' => $image ]);
    }

	

    /**
     * Loads search view and retrieves query results based on form input.
     *
     * @param  int  $media_image_id
     * @return Response
     */



	public function searchMedia()
	{


		$mediatypes = Media_Type::pluck('name', 'media_type_id');

		$value ="";

		$media_type_id = 1;

		if(Input::exists('Go')===true)
		{

		$value = Input::get('value');
		$media_type_id = Input::get('media_type_id');	


		//$results =  Media::all();

		$results = Media::where('name', 'like', '%' . $value . '%')->where('media_type_id', $media_type_id )->paginate(15);

		
		
		return view('media.search', ['results' => $results , 'media_type' => $mediatypes , 'media_type_id' => $media_type_id , 'value' => $value ]);

		}



	 return view('media.search', [ 'media_type' => $mediatypes  , 'media_type_id' => $media_type_id , 'value' => $value ] );


	}



}