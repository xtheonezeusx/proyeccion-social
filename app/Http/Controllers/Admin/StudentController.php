<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use DataTables;
use Validator;
use App\Activity;

class StudentController extends Controller
{
    public function getStudents($id)
    {
        $students = Student::where('group_id', $id)->select(['id', 'name', 'code']);
        return Datatables::of($students)
        ->addColumn('action', function($student) {
            return '<div class="btn-group" role="group" aria-label="Basic example"><a href="#" class="btn btn-sm btn-primary edit" id="' . $student->id . '">Editar</a><a href="#" class="btn btn-sm btn-danger delete" id="' . $student->id . '">Eliminar</a></div>';
        })
        ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:students',
            'name' => 'required',
            'group_id' => 'required'
        ]);
        
        $errors = array();
        $message = '';

        if ($validator->fails())
        {
            foreach ($validator->errors()->all() as $error)
            {
                $errors[] = $error;
            }
        }
        else
        {
            $student = Student::create([
                'code' => $request->code,
                'name' => $request->name,
                'group_id' => $request->group_id,
            ]);

            $message = '<div class="alert alert-success">Estudiante creado exitosamente</div>';
        }

        $output = array(
            'errors' => $errors,
            'message' => $message,
        );
        return $output;
    }

    public function getStudent(Student $student)
    {
        return $student;
    }

    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:students,code,' . $student->id,
            'name' => 'required',
        ]);

        $errors = array();
        $message = '';

        if ($validator->fails())
        {   
            foreach ($validator->errors()->all() as $error)
            {
                $errors[] = $error;
            }
        }
        else
        {
            $student->update([
                'code' => $request->code,
                'name' => $request->name,
                'student_id' => $request->student_id,
            ]);
            $message = '<div class="alert alert-success">Estudiante actualizado exitosamente.</div>';
        }

        $output = array(
            'errors' => $errors,
            'message' => $message,
        );

        return $output;
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return "Estudiante eliminado exitosamente";
    }
    
}
