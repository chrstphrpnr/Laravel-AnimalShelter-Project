<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rescuer;
use App\Models\Adopters;
use App\Models\Personnel;
use Illuminate\Support\Facades\Event;
use App\Events\RescuerCreated;
use App\Mail\Verify;
use DB;
use Auth;
use Mail;


class LoginController extends Controller
{


    public function getSignup(){
        return view('User.signup');
    }

    public function postSignup(Request $request){

        $this->validate($request, [
            'fname' => 'required| min:4',
            'role' => 'required| min:4',
            'email' => 'email|required|unique:users',
            'password' => 'required| min:4'
        ]);

         $user = new User([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'contact' => $request->input('contact'),
            'role' => $request->input('role'),
            'status' => 'Activated', 
            'status' => 'not verified', 
            //'status' => $request->status = 'Activated',
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
            $user->save();
            Mail::to('admin@animalshelter.com')->send(new Verify($user));
            Auth::login($user);
        
         if(auth()->user()->role == 'rescuer') {
            $rescuers = new Rescuer;
            $rescuers->user_id = $user->id;
            $rescuers->rescuer_fname = $request ->fname;
            $rescuers->Lname = $request ->lname;
            $rescuers->Age = $request ->age;
            $rescuers->Gender = $request->gender;
            $rescuers->Address = $request->address;
            $rescuers->Contact = $request->contact;
            $rescuers->email = $request->email;
            $rescuers->save();

            // Event::dispatch(new RescuerCreated($rescuers));
            Auth::logout();
            return redirect()->route('user.signin');
            // return redirect()->route('rescuer.profile');
        }
        
        elseif(auth()->user()->role == 'personnel') {

            $personnel = new Personnel;
            $personnel->user_id = $user->id;
            $personnel->personnel_fname = $request->fname;
            $personnel->Lname = $request->lname;
            $personnel->Age = $request->age;
            $personnel->Gender = $request->gender;
            $personnel->Address = $request->address;
            $personnel->Contact = $request->contact;
            $personnel->email = $request->email;
            // $personnel->status = $request->status;
            $personnel->Password = $request->password;
            $personnel->save();

            Auth::logout();
            return redirect()->route('user.signin');
     
            // return redirect()->route('personnel.profile');
        }

        elseif(auth()->user()->role == 'adopter') {
            $adopter = new Adopters;
            $adopter->user_id = $user->id;
            $adopter->adopter_fname = $request ->fname;
            $adopter->Lname = $request ->lname;
            $adopter->Age = $request ->age;
            $adopter->Gender = $request->gender;
            $adopter->Address = $request->address;
            $adopter->Contact = $request->contact;
            $adopter->save();
            Auth::logout();
            return redirect()->route('user.signin');
           
            // return redirect()->route('adopter.profile');
        }

    }

    public function emailAdopter(Request $request, $id){

        $admin = User::where('id', $id)->first();
         $admin = DB::table('users')
           ->where('id',$id)
           ->update(array('email_verified' => 'verified'));

       return redirect()->route('user.signin')
       ->with('success','Email Successfully Verified.');
   }


   

    public function getSignin(){
        return view('User.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);
        if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
        {
            if (auth()->user()->email_verified == null){
                Auth::logout();
                return redirect()->route('user.signin')
             ->with('error','Please verify your account!');
            }

            elseif(auth()->user()->role == 'rescuer') {
                return redirect()->route('rescuer.profile');
            }
            elseif(auth()->user()->role == 'personnel') {

                return redirect()->route('personnel.profile');
            }
            elseif(auth()->user()->role == 'adopter') {
                return redirect()->route('adopter.profile');
            }

        }

        else{
            return redirect()->route('user.signin')
                ->with('error','Email-Address And Password Are Wrong.');
        }
     }

}


// 'gender' => $request->gender = 'Healthy',