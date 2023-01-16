<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// laravel package starts from Illuminate\
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Add new student to application after validating Request Body 
     */
    public function store(Request $request)
    {
        // 1. Ways to validate a Request Body 
        // $request->validate()
        // Validator::make()
        // $this->validate()

        $validator = Validator::make(
            $request->all(),
            [
                "name" => "required|min:10|max:90",
                "course" => "required|max:100",
                "email" => "required|email|max:100",
                "phone" => "required|min:10|max:10",
            ]
        );

        // 2. validate results 
        // {
        //     "status": 422,
        //     "message": { "course": [ "The course field is required." ]  }
        // }
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {
            // {
            //     "status": 200,
            //     "message": "Gagandeep Singh has been added"
            // }
            return response()->json([
                'status' => 200,
                'message' => $request->name . ' has been added'
            ], 200);
        }
    }
}
