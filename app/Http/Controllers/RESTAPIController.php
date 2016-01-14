<?php

namespace App\Http\Controllers;

use App\AccessTokenRest;
use App\ExamResultsRest;
use App\Rest\Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

class RESTAPIController extends Controller
{
    function allResults(Request $request)
    {
        if(AccessTokenRest::where("token","=",$request->access_token)->first() == null)
        {
            return json_encode(new Exception("Access Token Failed"));

        }

        $results = ExamResultsRest::all();
        return json_encode($results);
    }
}
