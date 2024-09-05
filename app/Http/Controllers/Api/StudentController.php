<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return StudentResource::collection(Student::orderBy('created_at', 'desc')->paginate(20));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'phone_number' => 'required|string|max:255',
            'date_of_birth' => 'required|string|max:255',
            'address' => 'string|max:255',
        ]);

        $data = Student::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'date_of_birth' => $validated['date_of_birth'],
            'address' => $validated['address'],
        ]);
        return new StudentResource($data);
    }

    public function show($id)
    {
        $data = Student::findOrFail($id);
        return new StudentResource($data);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $student->id,
            'phone_number' => 'required|string|max:255',
            'date_of_birth' => 'required|string|max:255',
            'address' => 'string|max:255',
        ]);
        $student->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'date_of_birth' => $validated['date_of_birth'],
            'address' => $validated['address'],
        ]);

        return new StudentResource($student);
    }

    public function destroy($id)
    {
        $data = Student::findOrFail($id);
        $data->delete();
        return response()->json(null, 204);
    }
}

