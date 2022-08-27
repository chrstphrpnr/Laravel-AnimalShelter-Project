<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\RescuerCreated;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Event;
Use App\Models\Rescuer;
Use App\Models\Animal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImport;
use App\Exports\ItemExport;
use App\Exports\PdfExport;
use App\Exports\ItemTableExport;
use App\Rules\ExcelRule;
use Yajra\Datatables\Datatables;

class RescuerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $rescuers = Rescuer::orderBy('id','DESC')->get();
        //  $rescuers = DB::table('rescuers')->simplePaginate(4);

        //  $rescuers = DB::table('rescuers')
        //     ->select('rescuers.*')
        //     ->orderBy('id','DESC')->get();

        // $animalrescuers = DB::table('rescuers')
        //     ->leftJoin('animal_rescuers','animal_rescuers.rescuer_id','=','rescuers.id')
        //     ->leftJoin('animals','animals.id','=','animal_rescuers.animal_id')
        //     ->select('animal_rescuers.rescuer_id','animals.Name')
        //     ->get();

        // $rescuers = Rescuer::with('animals')->get();


     

        return View::make('Rescuer.index');

    }

    public function getRescuer(){
        $rescuers = DB::table('rescuers')
            ->select('rescuers.*')
            ->get();

        return Datatables::of($rescuers)
        ->addColumn('action', 'Rescuer.action')
        ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animals = Animal::pluck('Name','id');
        return View::make('Rescuer.create',compact('animals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'rescuer_fname' => 'required|alpha||min:2|max:20',
            'Lname' => 'required|alpha||min:3|max:20',
            'Age' => 'numeric|min:18|max:65',
            'Gender' => 'required|in:Male,Female' ,
            'Address' => 'required|min:5|max:30',
            'Contact' => 'numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',

        ];

        $messages = [
            'required' => 'Field Empty!',
            'min' => 'Text Too Short!',
            'numeric'=>'Numbers Only',
            'rescuer_fname.required' => 'First Name Required',
            'Gender.required' => 'No Gender Selected',
            'Lname.required' => 'Last Name Required',
            'Age.min' => 'Invalid Age',
            'Age.max' => 'Invalid Age',
            'Contact.regex' => 'Invalid Contact Format',
        ];

        $validator = Validator::make($request->all(), $rules ,$messages);

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);

        }
        else{
            $input = $request->all();

                if(empty($request->animal_id)){
                    $rescuers = Rescuer::create($input);
                }

                else {
                    $rescuers = Rescuer::create($input);
                    foreach($request->animal_id as $animal_id){
                        DB::table('animal_rescuers')->insert(
                            ['animal_id' => $animal_id,
                            'rescuer_id' => $rescuers->id]);
                            
                        Event::dispatch(new RescuerCreated($rescuers));
                    }
            }

          

            return redirect()->route('Rescuer.index')
                            ->with('success','A new Record was created successfully.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rescuer = DB::table('rescuers')
        ->leftJoin('animal_rescuers','animal_rescuers.rescuer_id','=','rescuers.id')
        ->leftJoin('animals','animals.id','=','animal_rescuers.animal_id')
        ->select('rescuers.id','animals.Name','animal_rescuers.rescuer_id')
        ->where('rescuers.id',$id)
        ->toSql();

        $rescuers = Rescuer::find($id);
        $animalrescuers = DB::table('animal_rescuers')->where('rescuer_id', $id)->pluck('animal_id')->toArray();
        $animals = Animal::pluck('Name','id');

        return View::make('Rescuer.edit',compact('rescuers','rescuer','animalrescuers','animals'));
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
        $rules = [
            'rescuer_fname' => 'required|alpha||min:2|max:20',
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
        $rescuers = Rescuer::find($id);
        $animal_id = $request->input('animal_id');

        if(empty($animal_id)){
            DB::table('animal_rescuers')->where('rescuer_id',$id)->delete();
            }

            else{
            foreach($animal_id as $animalid){
                DB::table('animal_rescuers')->where('rescuer_id',$id)->delete();
            }

            foreach($animal_id as $animalid){
                DB::table('animal_rescuers')->insert(['animal_id'=>$animalid,'rescuer_id'=>$id]);
                Event::dispatch(new RescuerCreated($rescuers));
            }

            }

        $rescuers->update($request->all());

        return redirect()->route('Rescuer.index')
                        ->with('success','A Record was updated successfully.');
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
        DB::table('animal_rescuers')->where('rescuer_id',$id)->delete();
        $rescuers = Rescuer::find($id);
        $rescuers->delete();
        return redirect()->route('Rescuer.index')
        ->with('success','A Record was deleted successfully.');

    }
}
