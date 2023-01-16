<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;

// laravel package starts from Illuminate\
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

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

    /**
     * Update the existing record for a Matching ID for new updated values .. 
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if ($student == null) {
            return response()->json([
                "status" => 404,
                "message" => "ID " . $id . " not found"
            ]);
        } else {
            $student->name = $request->name;
            $student->course = $request->course;
            $student->email = $request->email;
            $student->phone = $request->phone;

            $hasUpdated = $student->update();

            return response()->json([
                "status" => $hasUpdated ? 200 : 500,
                $hasUpdated ? "student" : "message" => $hasUpdated ? $student : "Some Interval problem occured while communicating database.. "
            ]);
        }
    }
    /**
     * Deleting record matching any particular ID 
     */
    public function destroy($id)
    {
        $result = Student::find($id);

        if ($result == null) {
            return response()->json([
                "status" => 404,
                "message" => "ID " . $id . " not found"
            ], 404);
        } else {
            $value = $result->delete();

            return response()->json([
                "status" => $value ? 200 : 500,
                "message" => $value ? "Student ($result->name) has been deleted" : "Trouble deleting student record"
            ]);
        }
    }
}
