<?php
namespace App\Utilities;
use File;
use App\Utilities\ImageManipulator;
use Illuminate\Support\Facades\Facade;


class ResizeImage extends Facade
{

	 public static function processImage($imgName , $folder) 
	 {

	 	 $im = new ImageManipulator(base_path() . '/public/'.$folder.'/'.$imgName);


		    if($im->getWidth() > $im->getHeight())
		    {

		    $im->resample(1000 , 650);


		    }
		    else
		    {


		    $im->resample(650 , 1000);

		    }


		    $centreX = round($im->getWidth() / 2);
		    $centreY = round($im->getHeight() / 2);

		    


		    $x1 = $centreX - 200;
		    $y1 = $centreY - 130;

		    $x2 = $centreX + 200;
		    $y2 = $centreY + 130;

		    
		    $im->save(base_path() . '/public/'.$folder.'/image/'.$imgName);

		    $im->crop($x1, $y1, $x2, $y2); // takes care of out of boundary conditions automatically

		    $im->save(base_path() . '/public/'.$folder.'/thumb/'.$imgName);




		    File::delete(base_path() . '/public/'.$folder.'/'.$imgName);
	 	


	 }



}