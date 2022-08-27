<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rescuer;
use App\Models\Personnel;
use App\Models\Adopters;
use Auth;
use DB;
use Validator;
use View;


class ProfileController extends Controller
{
    public function RescuerProfile(){
        $rescuer = Auth::user()->rescuers;
        $rescuer = Rescuer::with('animals')->where('user_id', Auth::id())->first();
        return view('Rescuer.profile',compact('rescuer'));
    }
    public function rescuer_edit(){
        $rescuer = Rescuer::with('animals')->where('user_id',Auth::id())->first();
        return View::make('rescuer.editprofile',compact('rescuer'));
    }

    public function rescuer_update(Request $request,$rescuers){
        $rules = [
            'rescuer_fname' => 'required|alpha||min:2|max:20',
            'Lname' => 'required|alpha||min:3|max:20',
            'Age' => 'numeric|min:18|max:65',
            'Gender' => 'required|in:Male,Female' ,
            'Address' => 'required|min:5|max:50',
            
        ];

        $messages = [
            'required' => 'Field Empty!',
            'min' => 'Text Too Short!',
            'numeric'=>'Numbers Only',
            'rescuer_fname.required' => 'First Name Required',
            'Lname.required' => 'Last Name Required',
            'Age.min' => 'Age too young must be over 18.',
            'Age.max' => 'Age too old must be under 65.',
            'Address.min' => 'Address too short!',
            'Address.max' => 'Address too long!',
            

        ];

        $validator = Validator::make($request->all(), $rules ,$messages);

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);

        }
        else{
        $input = $request->all();
        $rescuers = Rescuer::with('animals')->where('user_id',Auth::id())->first();
        $rescuers->update($input);
        return redirect()->route('rescuer.profile')
                        ->with('success','A Record was updated successfully.');
        }
        
    }

    public function PersonnelProfile(){
        $personnel = Auth::user()->personnels;
        $personnel = Personnel::with('animals')->where('user_id',Auth::id())->first();
        return view('Personnel.profile',compact('personnel'));
    }

    public function personnel_edit($personnel){
        $personnel = Personnel::with('animals')->where('user_id',Auth::id())->first();
        return View::make('personnel.editprofile',compact('personnel'));
    }


    public function personnel_update(Request $request,$personnels){
        $rules = [
            'personnel_fname' => 'required|alpha||min:2|max:20',
            'Lname' => 'required|alpha||min:3|max:20',
            'Gender' => 'required|in:Male,Female' ,
            'Role' => 'required|in:Employee,Veterinarian,Volunteer',
            'Email' => 'required|email',
            'Password' => 'required|alpha_num',

        ];

        $messages = [
            'required' => 'Field Empty!',
            'min' => 'Text Too Short!',
            'numeric'=>'Numbers Only',
            'personnel_fname.required' => 'First Name Required',
            'Lname.required' => 'Last Name Required',
            'Contact.regex' => 'Invalid Contact Format',
        ];
        $validator = Validator::make($request->all(), $rules ,$messages);

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);

        } else {
                        $input = $request->all();
                        $personnels = Personnel::with('animals')->where('user_id',Auth::id())->first();
                        $personnels->update($input);
                        return redirect()->route('personnel.profile')
                                        ->with('success','A Record was updated successfully.');
                        }
        }
















        public function AdopterProfile(){
            $adopter = Auth::user()->adopters;
            $adopter = Adopters::with('animals')->where('user_id', Auth::id())->first();
            return view('adopter.profile',compact('adopter'));
        }


        public function adopter_edit(){
            $adopter = Adopters::with('animals')->where('user_id',Auth::id())->first();
            return View::make('adopter.fix',compact('adopter'));
        }
    
        public function adopter_update(Request $request,$adopters){
            $rules = [
                'adopter_fname' => 'required',
                'Lname' => 'required|alpha||min:3|max:20',
                'Age' => 'numeric|min:18|max:65',
                'Gender' => 'required|in:Male,Female' ,
                'Address' => 'required|min:5|max:50',
                'Contact' => 'numeric|regex:/(09)[0-9]{9}/|max:9999999999',
                
            ];
    
            $messages = [
                'required' => 'Field Empty!',
                'min' => 'Text Too Short!',
                'numeric'=>'Numbers Only',
                'rescuer_fname.required' => 'First Name Required',
                'Lname.required' => 'Last Name Required',
                'Age.min' => 'Age too young must be over 18.',
                'Age.max' => 'Age too old must be under 65.',
                'Address.min' => 'Address too short!',
                'Address.max' => 'Address too long!',
                'Contact.max' => 'Contact Number too long!',
                
    
            ];
    
            $validator = Validator::make($request->all(), $rules ,$messages);
    
            if ($validator->fails()) {
    
                return redirect()->back()->withInput()->withErrors($validator);
    
            }
            else{
            $input = $request->all();
            $adopters = Adopters::with('animals')->where('user_id',Auth::id())->first();
            $adopters->update($input);
            return redirect()->route('adopter.profile')
                            ->with('success','A Record was updated successfully.');
            }
            
        }




}
