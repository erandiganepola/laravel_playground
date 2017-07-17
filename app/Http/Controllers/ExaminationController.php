<?php

namespace App\Http\Controllers;

use App\Examination;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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


    public function addExamination(Request $request) {
        $this->authorize("add", "App\\Examination");
        $validator = \Validator::make($request->all(), [
            "name" => "required",
            "year" => "required|numeric|min:2016|max:2050"
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $exam = new Examination();
        $exam->creator()->associate(Auth::user());
        $exam->name   = $request->name;
        $exam->year   = $request->year;
        $exam->status = false;
        $exam->save();

        return back()->with("success", "Exam added successfully");
    }

    /**
     * Current user's examinations view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllExaminationsOfCurrentUser() {
        $user = Auth::user();
        $this->authorize('view', "App\\Examination");
        $exams = $user->examinations;

        return view("student.student", ['exams' => $exams]);
    }

    /**
     * Upcoming examinations
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUpcomingExaminations() {
        $this->authorize("view", "App\\Examination");
        $exams = Examination::where("status", false)->get();

        return view("student.examApplications", ['exams' => $exams]);
    }

    /**
     * Registers for a given examination
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function applyExamination($id) {
        $exam = Examination::find($id);
        $this->authorize('apply', $exam);
        $user = Auth::user();
        if ($user->examinations()->where("name", $exam->name)->wherePivot("attempt", 3)->count() > 0) {
            return back()->withErrors(["error" => "You have already sat 3 times for this examination"]);
        }

        $attempt = 1;
        while ($attempt <= 3) {
            if ($user->examinations()->where("name", $exam->name)->wherePivot("attempt", $attempt)->count() == 0) {
                break;
            }
            $attempt++;
        }
        $user->examinations()->attach($exam, ["attempt" => $attempt]);
        $user->update();

        return back()->with("success", "Application for the examination submitted");
    }
}
