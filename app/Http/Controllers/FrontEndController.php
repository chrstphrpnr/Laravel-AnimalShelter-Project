<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Animal;
Use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\View;
use Session;

class FrontEndController extends Controller
{
    public function homepage(){
        $animals = DB::table('animals')
        ->select('animals.*')
        ->where('AdaptionStatus','Adoptable')->get();
        return view('frontend.frontpage',compact('animals'));
    }

    public function pets(){


        // $search = request()->query('search');
        //  if($search){
        //      $animals = Animal::where('AdaptionStatus','LIKE', "%{$search}%")
        //      ->orWhere('Sex','LIKE', "%{$search}%")
        //      ->orWhere('Breed','LIKE', "%{$search}%")
        //      ->orWhere('Type','LIKE', "%{$search}%")
        //      ->orWhere('Name','LIKE', "%{$search}%")->simplePaginate(4);
        //      return view('frontend.pets',compact('animals'));
        //  }

        $animals = DB::table('animals')
        ->select('animals.*')
        ->whereIn('AdaptionStatus', ['Pending', 'Adoptable'])->get();
        return view('frontend.pets',compact('animals'));

    }

    public function show($id) {
        $animal = Animal::find($id);

        $comment = Comment::with('animals')->get();

        $animals = DB::table('animals')->select('animals.*')->get();
        $animals = Animal::find($id);

        

        

        return View::make('frontend.info',compact('animals','comment'));
   }

   public function adopters(){
    $adopters  = DB::table('adopters')
    ->leftJoin('animal_adopters','animal_adopters.adopter_id','=','adopters.id')
    ->leftJoin('animals','animals.id','=','animal_adopters.animal_id')
    ->select('animal_adopters.adopter_id','adopters.*','animals.Name','animals.image','animals.AdaptionStatus')
    ->get();
    return view('frontend.adopters',compact('adopters'));
    }

    public function comment(Request $request)
    {
        $rules=[
            'name' => 'required|profanity|max:20',
            'comment' => 'required|profanity||min:2|max:20',
            'animal_id' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);

        }
        else {

       $comments = new Comment([
        'name' => $request->get('name'),
        'comment' => $request->get('comment'),
        'animal_id' => $request->get('animal_id'),
        ]);  
       
        $comments ->save();
        Session::flash('success','Comment was added');

        return redirect()->route('pets')
        ->with('success','A new Record was created successfully.');

        }

        
        // return View::make('front.showanimal');
    }


}

