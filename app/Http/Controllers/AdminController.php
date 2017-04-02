<?php
namespace App\Http\Controllers;

use App\User;
use Mail;
use Auth;
use View;
use Hash;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Utilities\Utils;
use App\Http\Controllers\Controller;



class AdminController extends Controller
{


	public function index()
    {

    	$hello = "welcome to the dashboard";

    	return view('admin.index',['hello' => $hello]);

    }




}