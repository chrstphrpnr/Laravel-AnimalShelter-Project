<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Adopters;
Use App\Models\Animal;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImport;
use App\Exports\ItemExport;
use App\Exports\PdfExport;
use App\Exports\ItemTableExport;
use App\Rules\ExcelRule;
use Yajra\Datatables\Datatables;


class AdopterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $adopters = DB::table('adopters')
        // ->select('adopters.*')
        // ->orderBy('id','DESC')->get();

        // $animaladopters = DB::table('adopters')
        //     ->leftJoin('animal_adopters','animal_adopters.adopter_id','=','adopters.id')
        //     ->leftJoin('animals','animals.id','=','animal_adopters.animal_id')
        //     ->select('animal_adopters.adopter_id','animals.Name','animals.AdaptionStatus')
        //     ->get();

        // $adopters = Adopters::with('animals')->get();
        // dd($adopters);
        $admins = DB::table('users')
        ->select('users.*')
        ->whereIn('role', ['admin'])->get();
        return view('Adopter.index',compact('admins'));

    }

    public function getAdopter(){
        $adopters = DB::table('adopters')
        ->select('adopters.*')
        ->get();

        return Datatables::of($adopters)
        ->addColumn('action', 'Adopter.action')
        ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animals = Animal::where('AdaptionStatus','Adoptable')->pluck('Name','id');

        return View::make('Adopter.create',compact('animals'));
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

                if(empty($request->animal_id)){
                    $adopters =  Adopters::create($input);
            }

                else {
                    $adopters = Adopters::create($input);
                    foreach($request->animal_id as $animal_id){
                    Animal::where('id', $animal_id)->update(array('AdaptionStatus' => 'Adopted'));
                    DB::table('animal_adopters')->insert(
                        ['animal_id' => $animal_id,
                        'adopter_id' => $adopters->id]);
                    }


                return redirect()->route('Adopter.index')
                ->with('success','A new Record was created successfully.');

            }
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
        $adopter = DB::table('adopters')
        ->leftJoin('animal_adopters','animal_adopters.adopter_id','=','adopters.id')
        ->leftJoin('animals','animals.id','=','animal_adopters.animal_id')
        ->select('adopters.id','animals.Name','animal_adopters.adopter_id')
        ->where('adopters.id',$id)
        ->toSql();

        $adopters = Adopters::find($id);
        $animaladopters = DB::table('animal_adopters')->where('adopter_id', $id)->pluck('animal_id')->toArray();
        $animals = Animal::where('AdaptionStatus','Adoptable')->pluck('Name','id');

        return View::make('Adopter.edit',compact('adopter','adopters','animaladopters','animals'));
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

        } else {
                $adopters = Adopters::find($id);
                $animal_id = $request->input('animal_id');

                if(empty($animal_id)){
                DB::table('animal_adopters')->where('adopter_id',$id)->delete();
                }

                else{
                foreach($animal_id as $animalid){
                    DB::table('animal_adopters')->where('adopter_id',$id)->delete();
                }

                foreach($animal_id as $animalid){
                    Animal::where('id', $animal_id)
                    ->update(array('AdaptionStatus' => 'Adopted'));
                    DB::table('animal_adopters')->insert(['animal_id'=>$animalid,'adopter_id'=>$id]);
                }

                }

            $adopters->update($request->all());
            return redirect()->route('Adopter.index')
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
        DB::table('animal_adopters')->where('adopter_id',$id)->delete();
        $adopters = Adopters::find($id);
        $adopters->delete();
        return redirect()->route('Adopter.index')
        ->with('success','A Record was deleted successfully.');
    }
}
