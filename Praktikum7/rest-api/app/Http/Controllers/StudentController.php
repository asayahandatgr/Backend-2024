<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class StudentController extends Controller
{
    public function index() {
        $student = Student::all();

        $data =  [
            'message' => 'Get all student',
            'data' => $student
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
       $validator = FacadesValidator::make($request->all(), [
        'nama' => 'required',
        'nim' => 'numeric|required',
        'email' => 'email|required', 
        'jurusan' => 'jurusan|required',
       ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        $students = Student::create($request->all());

        $data = [
            'message' => 'Student is create success!!',
            'data' => $students,
        ];

        return response()->json($data, 201);
    }

    public function update(Request $request, string $id) {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->update([
            'id' => $id,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ]);

        $data = [
            'message' => 'Student updated successfully',
            'data' => $student
        ];
        return response()->json($data, 200);
    }

    public function destroy(string $id) {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();

        $data = [
            'message' => 'Student deleted successfully',
        ];
        return response()->json($data, 200);
    }

    public function show($id){
        $student = Student::find($id);

        if ($student) {
            $data =  [
                'message' => 'Get detail student',
                'data' => $student
            ];
            return response()->json($data, 200);
        } else {
            $data =  [
                'message' => 'Student not found',
            ];
            return response()->json($data, 404);
        }
    }
}
