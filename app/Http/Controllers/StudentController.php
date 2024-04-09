<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $student;
    public function __construct(){
        $this->student = new Student();
    }
    public function index()
    {
        $students = $this->student->getAll();
        
        return view('liststudent',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        	//Gán giá trị vào array
	$dataInsertToDatabase = array(
		'name'  => $request->name,
		'phone' => $request->phone,
	);
    $data = $this->student->insertData($dataInsertToDatabase);
        if($data){
            return redirect()->route('students.index')->with('msg',"data đã được thême");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = $this->student->getOne($id);
        return view('students.update',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStudent(Request $request)
    {
        $id = $request->id;
        $dataUpdate = [
            'name' => $request->name,
            'phone' => $request->phone
        ];
    
        $success = $this->student->updateStudent($id,$dataUpdate);
    
        if ($success) {
            return redirect()->route('students.index')->with('msg', "Data đã được cập nhật thành công");
        } else {
            return redirect()->route('students.edit', ['student' => $id])->with('msg', "Có lỗi xảy ra khi cập nhật");
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
{
    $success = $student->delete();

    if ($success) {
        return redirect()->route('students.index')->with('msg', "Student has been deleted successfully");
    } else {
        return redirect()->route('students.index')->with('error', "Failed to delete the student");
    }
}

}
