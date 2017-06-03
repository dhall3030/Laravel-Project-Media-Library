<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Mail;
use Auth;
use View;
use Hash;
use Session;
use Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;



class UserController extends Controller
{
    
	public function register()
    {


    	 

        if(Input::exists('Go')===true)
            
        {



            $rules = array(
                'name'    => 'required', // make sure the username field is not empty
                'email'    => 'required',
                'phone'    => 'required',
                'password' => 'required|alphaNum|min:6|same:password_confirmation' // password can only be alphanumeric and has to be greater than 6 characters
            );

            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {



                return Redirect::to('/register')
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form


                                
            } else {

                


                 $email=Input::get('email');

                 $checkemail= User::where('email',$email)->first(); 


                if(count($checkemail) > 0){

                    $errors = new MessageBag(['password' => ['An account already exists under the email '.$email.'.']]); 
                    return Redirect::to('/register')->withErrors($errors)->withInput();



                                       
                }
                else
                {


                     $date = date('Y-m-d H:i:s');

               
            		 

                     $name=Input::get('name');
                     $email=Input::get('email');
                     $phone=Input::get('phone');
                     $password=Input::get('password');




                     $password=bcrypt($password);


                	 $user = new User;
                	 $user->name = $name;
                	 $user->phone =  $phone;
                     $user->email =  $email;
                     $user->password = $password;
                     //$user->role_id = 1;
                     
                     $user->last_login = $date;

                     $user->current_login = $date;



                     $user->created_at = $date;
                     $user->updated_at = $date;

                     $user->save();

                     //$user->roles()->attach(1);

                     

                   


                     Auth::login($user);




                     return Redirect::to('admin-dashboard')->withFlashMessage('User Created Successfully.');

                }

            }

        }

        return view('user.register');


    }


    public function authenticate()
    {

        $rules = array(
            'email'    => 'required|email', 
            'password' => 'required|alphaNum|min:6' 
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            
            return Redirect::to('user-login')
                
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
            
        } else {



            $email=Input::get('email');
            $password=Input::get('password');
            $remember = (Input::has('remember')) ? true : false;
            $user = User::where('email', $email)->first();

            if(count($user)== 0)
            {

                    $errors = new MessageBag(['password' => ['Email and/or password invalid.']]); 
                    return Redirect::to('user-login')->withErrors($errors)->withInput(Input::except('password'));


            }


            if (Hash::check($password, $user->password))
            {

                Auth::login($user,$remember);


                $date = date('Y-m-d H:i:s');

                        if(is_null($user->current_login))

                        {

                        $user->current_login=$date;

                        }               

                $user->last_login = $user->current_login;

                $user->current_login = $date;

                $user->save();

                

                return redirect()->intended('admin-dashboard'); 






                
            
            


            }
            else
            {

            $errors = new MessageBag(['password' => ['Email and/or password invalid.']]); 
            return Redirect::to('user-login')->withErrors($errors)->withInput(Input::except('password'));


            }




        }

    }




    

    public function logout()
    {


         Session::flush();


         Auth::logout();

         return Redirect::to('user-login');





    }
    
   



     


    
    


    




}