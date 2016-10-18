<?php

namespace App\Http\Controllers;

use App\Examination;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExaminationController extends Controller {

    /**
     * Show UI with all exams
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAll() {
        $this->authorize('view', 'App\Examination');
        $examinations = Examination::orderBy("year", "asc")->orderBy("name")->get();

        return view("exams.exams", ['exams' => $examinations]);
    }
}
