<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Personnel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use DB;
Use App\Models\User;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImport;
use App\Exports\ItemExport;
use App\Exports\PdfExport;
use App\Exports\ItemTableExport;
use App\Rules\ExcelRule;
use Yajra\Datatables\Datatables;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('Personnel.index');
    }

    public function getPersonnel(){
        $personnels = DB::table('personnels')
        ->select('personnels.*')
        ->get();

        return Datatables::of($personnels)
        ->addColumn('action', 'Personnel.action')
        ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Personnel.create');
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
            'adopter_fname.required' => 'First Name Required',
            'Lname.required' => 'Last Name Required',
            'Contact.regex' => 'Invalid Contact Format',
        ];
        $validator = Validator::make($request->all(), $rules ,$messages);

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);

        } else {

        $personnels = $request->all();
        Personnel::create($personnels);

        


        return redirect()->route('Personnel.index')
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
        $personnels = Personnel::find($id);
      
       

        // $animaladopters = DB::table('animal_adopters')->where('adopter_id', $id)->pluck('animal_id')->toArray();
        return View::make('Personnel.edit',compact('personnels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
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
            'adopter_fname.required' => 'First Name Required',
            'Lname.required' => 'Last Name Required',
            'Contact.regex' => 'Invalid Contact Format',
        ];
        $validator = Validator::make($request->all(), $rules ,$messages);

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);

        } else {
        $personnels = Personnel::find($id);
        $personnels->update($request->all());
      
        return redirect()->route('Personnel.index')
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
        $personnels = Personnel::find($id);
        $personnels->delete();
        return redirect()->route('Personnel.index')
        ->with('success','A Record was deleted successfully.');
    }

    public function status_update(Request $request,$user_id){
          
       $users = Personnel::with('users')->find($user_id);
       $status = DB::table('users')
       ->select('users.status')
       ->where('id',$user_id)
       ->get();


       if($status = 'Activated'){

            $status = 'Deactivated';
            DB::table('users')
            ->where('id',$user_id)
            ->update(array('status'=>$status));

       }
       
       elseif($status = 'Deactivated'){
            $status = 'Activated';
            DB::table('users')
            ->where('id',$user_id)
            ->update(array('status'=>$status));
       }

       

    
        return redirect()->route('Personnel.index')
        ->with('success','A Record was updated successfully.');
    }
}
