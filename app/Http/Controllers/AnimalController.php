<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Animal;
Use App\Models\Rescuer;
Use App\Models\InjuryDisease;
Use App\Models\animal_injury;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImport;
use App\Exports\ItemExport;
use App\Exports\PdfExport;
use App\Exports\ItemTableExport;
use App\Rules\ExcelRule;
use Yajra\Datatables\Datatables;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$animals = Animal::orderBy('id','DESC')->get();

        // $animals = DB::table('animals');

        // $animalcount = DB::table('animals')->count();

        // $animals = DB::table('animals')
        //     ->select('animals.*')
        //     ->orderBy('id','DESC')->simplePaginate(4);


        // $animalinjuries = DB::table('animals')
        // ->leftJoin('animal_injuries','animal_injuries.animal_id','=','animals.id')
        // ->leftJoin('injury_diseases','injury_diseases.id','=','animal_injuries.injurydisease_id')
        // ->select('animal_injuries.animal_id','injury_diseases.health_problem')
        // ->get();

        // $animals = Animal::with('injuryDisease')->get();

     
        return view('Animal.index');

        //  return view('Animal.index');
    }

    
    public function getAnimal(){
        $animals = DB::table('animals')
        ->leftJoin('animal_injuries','animal_injuries.animal_id','=','animals.id')
        ->leftJoin('injury_diseases','injury_diseases.id','=','animal_injuries.injurydisease_id')
        ->select('animals.*','animal_injuries.animal_id','injury_diseases.health_problem');

        $table = Datatables::of($animals)
        ->addColumn('action', 'Animal.action');

        return $table->make(true);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $InjuriesDieseases = InjuryDisease::pluck('health_problem','id');

        return View::make('Animal.create',compact('InjuriesDieseases'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'Name' => 'required|alpha|max:20',
            'Type' => 'required|alpha||min:2|max:20',
            'Breed' => 'required|alpha||min:2|max:20',
            'Sex' => 'required|in:Male,Female' ,
            'Age' => 'numeric|max:30',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];

        $messages = [
            'required' => 'Field Empty!',
            'min' => 'Text Too Short!',
            'alpha' => 'Text Only',
            'numeric'=>'Numbers Only.',
            'Name.required' => 'Name Required.',
            'Type.required' => 'Type Required',
            'Breed.required' => 'Breed Required',
            'Sex.required' => 'Animal Sex Required',
            'Age.numeric' => 'Number Only',
            'Age.max' => 'Invalid Age',
            'image.mimes' => 'Invalid Image Format',

        ];

        $validator = Validator::make($request->all(), $rules ,$messages);

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);

        }
        else {
            $input = $request->all();

                if($request->hasFile('image')) {

                    $image = $request->file('image')->getClientOriginalName();
                    $request->file('image')->storeAs('public/Images',$image);
                    $input['image'] = 'public/Images/'.$image;

                }

                    if(empty($request->injurydisease_id)) {
                        $animals = Animal::create($input);
                    } else {
                        $animals = Animal::create($input);
                        foreach($request->injurydisease_id as $injurydisease_id){
                            DB::table('animal_injuries')->insert(
                                ['injurydisease_id' => $injurydisease_id,
                                'animal_id' => $animals->id]);
                        }
       }

       $adaption = DB::table('animals')->latest()->first();
       if(empty($request->injurydisease_id)){
            $status = Animal::find($adaption->id);
            $status->AdaptionStatus = 'Adoptable';
            $status->HealthStatus = 'Healthy';
            $status->save();
       } else{
            $status = Animal::find($adaption->id);
            $status->AdaptionStatus = 'Pending';
            $status->HealthStatus = 'Sick';
            $status->save();
       }


        return redirect()->route('Animal.index')
                        ->with('success','A new Record was created successfully.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $animal = DB::table('animals')
        ->leftJoin('animal_injuries','animal_injuries.animal_id','=','animals.id')
        ->leftJoin('injury_diseases','injury_diseases.id','=','animal_injuries.injurydisease_id')
        ->select('animals.id','injury_diseases.health_problem','animal_injuries.injurydisease_id')
        ->where('animals.id',$id)
        ->toSql();

        $animals = Animal::find($id);
        $animalinjuries = DB::table('animal_injuries')->where('animal_id', $id)->pluck('injurydisease_id')->toArray();
        $injurydieases = InjuryDisease::pluck('health_problem','id');


        return view('Animal.edit',compact('animals','animal','animalinjuries','injurydieases'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
            'Name' => 'required|alpha|max:20',
            'Type' => 'required|alpha||min:2|max:20',
            'Breed' => 'required|alpha||min:2|max:20',
            'Sex' => 'required|in:Male,Female' ,
            'Age' => 'numeric|max:30',
            // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];

        $messages = [
            'required' => 'Field Empty!',
            'min' => 'Text Too Short!',
            'alpha' => 'Text Only',
            'numeric'=>'Numbers Only.',
            'Name.required' => 'Name Required.',
            'Type.required' => 'Type Required',
            'Breed.required' => 'Breed Required',
            'Sex.required' => 'Animal Sex Required',
            'Age.numeric' => 'Number Only',
            'Age.max' => 'Invalid Age',
            'image.mimes' => 'Invalid Image Format',

        ];

        $validator = Validator::make($request->all(), $rules ,$messages);

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);

        } else {
            $animals = Animal::find($id);
            $injurydisease_id = $request->input('injurydisease_id');
            $input = $request->all();

            if($request->hasFile('image')){
                    $image = $request->file('image')->getClientOriginalName();
                    $request->file('image')->storeAs('public/Images',$image);
                    $input['image'] = 'public/Images/'.$image;
            }

            if(empty($injurydisease_id)){
                DB::table('animal_injuries')->where('animal_id',$id)->delete();
            }

            else{
            foreach($injurydisease_id as $injurydiseaseid){
                DB::table('animal_injuries')->where('animal_id',$id)->delete();

            }

            foreach($injurydisease_id as $injurydiseaseid){
                DB::table('animal_injuries')->insert(['injurydisease_id'=>$injurydiseaseid,'animal_id'=>$id]);
            }

            }

            if(empty($injurydisease_id)){
            $animals->AdaptionStatus = 'Adoptable';
            $animals->HealthStatus = 'Healthy';
            $animals->save();
       } else{
            $animals->AdaptionStatus = 'Pending';
            $animals->HealthStatus = 'Sick';
            $animals->save();
            }



            $animals->update($input);
            return redirect()->route('Animal.index')
                        ->with('success','Record updated successfully');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('animal_injuries')->where('animal_id',$id)->delete();
        DB::table('animal_rescuers')->where('animal_id',$id)->delete();
        $animals = Animal::find($id);
        $animals->delete();
        return redirect()->route('Animal.index')
        ->with('success','A Record was deleted successfully.');
    }

   
}
