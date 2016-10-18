<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ResultController extends Controller {
    public function getAll() {
        $this->authorize("view", "App\\Result");

        return view("student.student", []);
    }
}
