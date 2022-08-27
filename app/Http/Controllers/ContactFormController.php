<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
Use App\Models\messages;
use DB;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $message = messages::all();

        return view('contacts.index',compact('message'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $message = messages::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'message'=>$request->input('message'),
            ]);

            $message->save();

            $data = array('name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'message'=>$request->input('message'));

            Mail::send(['html'=>'contacts.create'],
            array('name'=>$request->input('name'),
            'message'=>$request->input('message'),
            'email'=>$request->input('email')),

            function($message) use($data) {
                $message->to('admin@ShawShelter')->subject
                   ('Laravel Basic Testing Mail');
                $message->from($data['email']);
             });

            return redirect('contact')
            ->with('success','A new Record was created successfully.');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = messages::find($id);
        $message->delete();
        return redirect()->back();
    }
}
