<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Person;
use App\Models\Student;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $student = Student::FromID("1");
        echo $student->getName();
        $parent = Guardian::fromNIC("931931931V");

        $student->setGuardian($parent);

    }


}
