<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\MusicClass;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Log;
use DB;
use Exception;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes=MusicClass::getClasses();
        return view('Classes.classes',['classes'=>$classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instruments = Instrument::getInstruments();
        return view('Classes.addClass', ['instruments' => $instruments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info($request->all());
        /*
                'code' => 'VC',
          'name' => 'Violin Class',
          'class_type' => 'G',
          'instrument' =>
          array (
              0 => 'Violin',
              1 => 'Select Instrument',
              2 => 'Select Instrument',
          ),
          'start_date' => '2015-12-20',
          'duration_hours' => '2',
          'duration_minutes' => '00',
          'day_of_week' => 'Monday',
          'time' => '06:00',*/

        $validator = Validator::make($request->all(), array(
            'code'=>'required',
            'name' => 'required',
            'class_type' => 'required|in:G,I',
            'instrument' => 'required|array',
            'start_date' => 'required|date|after:tomorrow',
            'duration_hours' => 'required|numeric|min:0',
            'duration_minutes' => 'required|numeric|min:0',
            'day_of_week' => 'required|in:MON,TUE,WED,THU,FRI,SAT,SUN',
            'time' => 'required|date_format:H:i'
        ));

        if ($validator->fails()) {
            return back()->with('errors', $validator->errors()->all())->withInput();
        }

        $musicClass=new MusicClass();
        $musicClass->setIDCode($request->code);
        $musicClass->setName($request->name);
        $musicClass->setType($request->class_type);
        $musicClass->setInstruments(array_filter($request->instrument));
        $musicClass->setDayOfWeek($request->day_of_week);
        $musicClass->setDuration($request->duration_hours);
        $musicClass->setTime($request->time);
        $musicClass->setStartDate($request->start_date);


        DB::beginTransaction();
        try {
            MusicClass::insertClass($musicClass);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return back()->with('errors', array('Something went wrong!'))->withInput();
        }
        DB::commit();


        return back()->with('success',$request->name." successfully added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
