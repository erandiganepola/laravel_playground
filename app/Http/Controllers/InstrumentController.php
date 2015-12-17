<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instruments=Instrument::getInstruments();
        return view('Settings.instruments',['instruments'=>$instruments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Settings.addInstrument');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private $name ;
    public function store(Request $request)

        {
            $validator=Validator::make($request->all(),array(
                'name'=>'required',

            ));

            //if validation fails
            if($validator->fails()){
                return back()->with('errors',$validator->errors()->all())->withInput();
            }

            $instrument=new Instrument();
            $name = name;
//            $instrument->insertInstrument($request->name);



            DB::beginTransaction();
            try{
                Instrument::insertInstrument($name);
            }
            catch(Exception $e){
                DB::rollback();
                Log::error($e->getMessage());
                return back()->with('errors',array("Something went wrong!"))->withInput();
            }
            DB::commit();

            return back()->with('success', $request->name . " added successfully!");
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
        //
    }
}
