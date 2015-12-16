<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Person;
use App\Models\Student;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Log;
use Exception;
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::getStudents();
        return view('Students.students', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Students.addStudent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'name' => 'required',
            'gender' => 'required|in:F,M',
            'email' => 'required|email',
            'address' => 'required',
            'birthday' => 'required|date|before:' . date('Y-m-d'),
            'phone' => 'required|array',
            'parentSearchNic' => 'required',
            'parentGender' => 'in:F,M',
            'parentPhone' => 'array'
        ));

        if ($validator->fails()) {
            return back()->with('errors', $validator->errors()->all())->withInput();
        }

        $parent = Guardian::find($request->parentSearchNic);
        $parentAvailable = true;
        if ($parent == null) {
            // if the parent is already stored
            $parentAvailable = false;

            /**
             * Add a parent id not exists.
             */
            $parentValidator = Validator::make($request->all(), array(
                'parentSearchNic' => 'required|unique:parent,nic',
                'parentGender' => 'required|in:F,M',
                'parentPhone' => 'required|array',
                'parentPhone' => 'required',
                'parentName' => 'required'
            ));

            if ($parentValidator->fails()) {
                return back()->with('errors', $validator->errors()->all())->withInput();
            }

            $parent = new Guardian();
            $parent->setName($request->parentName);
            $parent->setNIC($request->parentSearchNic);
            $parent->setGender(Person::parseGender($request->parentGender));
            $parent->setPhones(array_filter($request->parentPhone));
        }

        //add the student
        $student = new Student();
        $student->setName($request->name);
        $student->setAddress($request->address);
        $student->setGender($request->gender);
        $student->setDOB($request->birthday);
        $student->setEmail($request->email);
        $student->setPhones(array_filter($request->phone));


        DB::beginTransaction();
        try {
            $student = Student::insertStudent($student);

            //add parent if not available
            if (!$parentAvailable)
                Guardian::insertParent($parent);

            //add parent to the student
            if (isset($request->isGuardian)) {
                $student->setGuardian($parent);
            } else {
                $student->addParent($parent);
            }

        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return back()->with('errors', array("Something went wrong!"))->withInput();
        }
        DB::commit();


        return back()->with('success', $request->name . " added successfully!");

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
