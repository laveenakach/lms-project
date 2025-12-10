<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            // Admin sees all records
            $assignments = Assignment::with(['student', 'trainer'])
                ->latest()
                ->get();
        } elseif (Auth::user()->role === 'trainer') {
            // Trainer sees only their records
            $assignments = Assignment::with(['student', 'trainer'])
                ->where('trainer_id', Auth::id())
                ->latest()
                ->get();
        } elseif (Auth::user()->role === 'student') {
            // Student sees only their records
            $assignments = Assignment::with(['student', 'trainer'])
                ->where('student_id', Auth::id())
                ->latest()
                ->get();
        }

        return view('student.assignments.index', compact('assignments'));
    }

    public function create($id = null)
    {
        $assignment = $id ? Assignment::findOrFail($id) : new Assignment();
        $users = User::where('role', ['student'])->latest()->get();
        return view('student.assignments.create', compact('assignment', 'users'));
    }

    public function store(Request $request, $id = null)
    {
        // echo"<pre>";
        // print_r($request->all());
        // die;

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'submission_date' => 'nullable|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,zip|max:10240',
        ]);

        $data = $request->only(['title', 'description', 'submission_date','status','feedback']);

        $data['student_id'] = $request->student_id;
        $data['trainer_id'] = $request->trainer_id;

        // Handle photo upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/assignments'), $filename);
            $data['file_path'] = $filename;
        }

        if ($id) {
            $assignment = Assignment::findOrFail($id);
            $assignment->update($data);
            $message = 'Assignment updated successfully!';
        } else {
            Assignment::create($data);
            $message = 'Assignment submitted successfully!';
        }

        return redirect()->route('student.assignments.index')->with('success', $message);
    }

    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);

        if ($assignment->file_path && file_exists(public_path('uploads/assignments/' . $assignment->file_path))) {
            unlink(public_path('uploads/assignments/' . $assignment->file_path));
        }
        $assignment->delete();

        return redirect()->back()->with('success', 'Assignment deleted successfully.');
    }
}
