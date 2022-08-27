<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Models\InjuryDisease;
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


class InjuryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $search = request()->query('search');
        // if($search){
        //     $injurydiseases = InjuryDisease::where('health_problem','LIKE', "%{$search}%")->simplePaginate(4);
        //     return view('InjuryDisease.index',compact('injurydiseases'));
        // }
        // else{
        // }

        // $injurydiseases = InjuryDisease::select('id','health_problem');

      
        return view('InjuryDisease.index');
    }

    public function getInjury(){
        $injurydiseases = DB::table('injury_diseases')
        ->select('id','health_problem');

        return Datatables::of($injurydiseases)
        ->addColumn('action', 'InjuryDisease.action')
        ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('InjuryDisease.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules= [
            'health_problem' => 'required|min:2|max:20|unique:injury_diseases,health_problem',
        ];

        $messages = [
            'required' => 'Field Empty',
            'alpha' => 'Letter Only',
            'health_problem.min' => 'Invalid Injury/Disease Type',
            'health_problem.max' => 'Invalid Injury/Disease Type',
        ];


        $validator = Validator::make($request->all(), $rules ,$messages);

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);

        } else {
            $injurydiseases = $request->all();
            InjuryDisease::create($injurydiseases);


            return redirect()->route('InjuryDisease.index')
                            ->with('success','A new Record was created successfully.');

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $injurydiseases = InjuryDisease::find($id);
        return View::make('InjuryDisease.edit',compact('injurydiseases'));

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

         $rules= [
            'health_problem' => 'required|alpha|min:2|max:20',
        ];

        $messages = [
            'required' => 'Field Empty',
            'alpha' => 'Letter Only',
            'health_problem.min' => 'Invalid Injury/Disease Type',
            'health_problem.max' => 'Invalid Injury/Disease Type',
        ];


        $validator = Validator::make($request->all(), $rules ,$messages);

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);

        } else {

            $injurydiseases = InjuryDisease::find($id);
            $injurydiseases->update($request->all());
            return redirect()->route('InjuryDisease.index')
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
        DB::table('animal_injuries')->where('injurydisease_id',$id)->delete();
        $injurydiseases = InjuryDisease::find($id);
        $injurydiseases->delete();
        return redirect()->route('InjuryDisease.index')
        ->with('success','A Record was deleted successfully.');

    }
}
