<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Person;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Log;
use Exception;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers=Teacher::getTeachers();
        return view('Teachers.teachers',['teachers'=>$teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Teachers.addTeacher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),array(
            'name'=>'required',
            'gender'=>'required|in:M,F',
            'nic'=>'required',
            'birthday'=>'required|date|before:'.date('Y-m-d'),
            'phone'=>'required|array',
            'address'=>'required'
        ));

        //if validation fails
        if($validator->fails()){
            return back()->with('errors',$validator->errors()->all())->withInput();
        }

        $teacher=new Teacher();
        $teacher->setName($request->name);
        $teacher->setNIC($request->nic);
        $teacher->setGender(Person::parseGender($request->gender));
        $teacher->setPhones(array_filter($request->phone));
        $teacher->setDOB($request->birthday);
        $teacher->setAddress($request->address);
        $teacher->activate();

        //insert the teacher in a transaction
        DB::beginTransaction();
        try{
            Teacher::insertTeacher($teacher);
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
        $teacher=Teacher::fromID($id);

        return view('Teachers.profile',['teacher'=>$teacher]);
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
