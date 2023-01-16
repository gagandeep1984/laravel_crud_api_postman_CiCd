<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;

// laravel package starts from Illuminate\
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    private $students = array();

    /**
     * provides default listing of students
     */
    public function index()
    {
        $results = Student::all();
        // $results = Student::select("name", "email")->get();

        return response()->json(
            [
                "status" => 200,
                "students" => $results
            ]
        );
    }

    /**
     * fetching record based on specific ID 
     */
    public function show($id)
    {
        $result = Student::find($id);

        return response()->json([
            "status" => 200,
            "students" => $result
        ]);
    }

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
            $student = new Student;
            $student->name = $request->name;
            $student->course = $request->course;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $isSaved = $student->save();

            // print("Saved  : " . $isSaved);

            // print_r($request);
            // array_push($this->students, $request->all());
            // {
            //     "status": 200,
            //     "message": "Gagandeep Singh has been added"
            // }

            return response()->json([
                'status' => 200,
                'message' => $isSaved ? $student->name . ' has been added' : "There was some problem in saving student information"
            ], 200);
        }
    }
}
