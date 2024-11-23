<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::paginate(15);
        return view('student.student',['students'=>$students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        // dd($request->all());
        $student = new Student();
    
        $student->name = $request->input('name');
        $student->phone_number = $request->input('phone_number');
    
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
            $student->image_path = $imagePath;
        }
    
        $student->save();
    
        return redirect()->route('student.index')->with('success', 'Student created successfully!');
    }
    

    
    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('student.student_show',['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('student.student_edit',['student'=>$student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $student = Student::findOrFail($id);

        $student->name = $request->input('name');
        $student->phone_number = $request->input('phone_number');

        if ($request->hasFile('image_path')) {
            if ($student->image_path && Storage::exists('public/' . $student->image_path)) {
                Storage::delete('public/' . $student->image_path);
            }

            $imagePath = $request->file('image_path')->store('images', 'public');
            $student->image_path = $imagePath;
        }

        $student->save();

        return redirect()->route('student.index')->with('success', 'Student updated successfully!');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::find($id);
    
        if ($student->image_path && Storage::exists('public/' . $student->image_path)) {
            Storage::delete('public/' . $student->image_path);
        }
    
        $student->delete();
    
        return redirect()->route('student.index')->with('success', 'Student deleted successfully!');
    }
    
}
