<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudent;
use App\Models\Category;
use App\Models\Student;
use App\Models\Place;

class StudentController extends Controller
{
  /**
   * Show Student Index Page
   *
   * @return view
   */
  public function index()
  {
    $students = Student::latest()->search()->with(['place', 'category'])->paginate(10);
    //$students = Student::search()->with(['place', 'category'])->paginate(10);
    //$students = Student::latest()->search()->paginate(10);
    return view('students.index', compact('students'));
  }

  /**
   * Create a new Student
   *
   * @return view
   */
  public function create()
  {
    $places = Place::all();
    $categories = Category::all();
    return view('students.create', compact('places', 'categories'));
  }

  /**
   * Save the Student data to the database
   *
   * @param StoreStudent $request
   * @return view
   */
  public function store(StoreStudent $request)
  {
    $students = $request->all();

    $cats = $request->cat;
    if ($request->hasFile('image')) {
      $imageName = time() . '.' . $request->image->extension();
      $request->image->move(storage_path('app/public/images'), $imageName);
    }

    $students = Student::create([
      'name' => $request->name,
      'image' => $imageName,
      'place_id' => $request->place_id,
    ]);

    $students->category()->attach($cats);
    return redirect('student')->with('success', 'Student Added!');
  }


  /**
   * Show the student
   *
   * @param [int] $id
   * @return view
   */
  public function show($id)
  {
    $student = Student::find($id);
    $students = $student->category();
    return view('students.show')->with('students', $student, $students);
  }

  /**
   * Edit the student data
   *    
   * @param [int] $id
   * @return view
   */
  public function edit($id)
  {
    $student = Student::find($id);
    $places = Place::all();
    $categories = Category::all();
    return view('students.edit', compact('places', 'categories', 'student'));
  }

  /**
   * Update the student data
   *
   * @param StoreStudent $request
   * @param [int] $id
   * @return view
   */
  public function update(StoreStudent $request, $id)
  {
    $student = Student::find($id);
    if ($request->hasFile('image')) {
      unlink(storage_path('app/public/images/') . $student->image);
      $imageName = time() . '.' . $request->image->extension();
      $request->image->move(storage_path('app/public/images'), $imageName);
    } else {
      $imageName = $student->image;
    }

    $student->update([
      'name' => $request->name,
      'image' => $imageName,
      'place_id' => $request->place_id,
    ]);

    return redirect('student')->with('success', 'Student Updated!');
  }

  /**
   * Delete the student
   *
   * @param [int] $id
   * @return view
   */
  public function destroy($id)
  {
    $student = Student::find($id);
    unlink(storage_path('app/public/images/') . $student->image);
    $student->delete();

    return redirect('student')->with('success', 'Student deleted!');
  }
}
