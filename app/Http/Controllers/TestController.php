<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\MusicClass;
use App\Models\Person;
use App\Models\Student;
use App\Utils;
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
        $mc = new MusicClass();
        $mc->setIDCode("B");
        $mc->setName("AA");
        $mc->setDayOfWeek(Utils::WEEK_DAY_THURSDAY);
        $mc->setDuration(2.2);
        $dbFormat = date('H:i:s', strtotime('6:30 PM'));
        $mc->setTime($dbFormat);
        $mc->setType(MusicClass::TYPE_GROUP);
        $mc->setStartDate("2012-12-12");
        MusicClass::insertClass($mc);
        echo $mc->getID();

        $mcs = MusicClass::getClasses();
        var_dump($mcs);




    }


}
