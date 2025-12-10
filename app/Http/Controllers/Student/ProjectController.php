<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            // Admin sees all records
            $projects = Project::with(['student', 'trainer'])
                ->latest()
                ->get();
        } elseif (Auth::user()->role === 'trainer') {
            // Trainer sees only their records
            $projects = Project::with(['student', 'trainer'])
                ->where('trainer_id', Auth::id())
                ->latest()
                ->get();
        } elseif (Auth::user()->role === 'student') {
            // Student sees only their records
            $projects = Project::with(['student', 'trainer'])
                ->where('student_id', Auth::id())
                ->latest()
                ->get();
        }

        return view('student.projects.index', compact('projects'));
    }

    public function create($id = null)
    {
        $project = $id ? Project::findOrFail($id) : new Project();
        $users = User::where('role', ['student'])->latest()->get();
        return view('student.projects.create', compact('project', 'users'));
    }

    public function store(Request $request, $id = null)
    {
       
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
            $file->move(public_path('uploads/Projects'), $filename);
            $data['file_path'] = $filename;
        }


        if ($id) {
            $Project = Project::findOrFail($id);
            $Project->update($data);
            $message = 'Project updated successfully!';
        } else {
            Project::create($data);
            $message = 'Project submitted successfully!';
        }

        return redirect()->route('student.projects.index')->with('success', $message);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->file_path && file_exists(public_path('uploads/projects/' . $project->file_path))) {
            unlink(public_path('uploads/projects/' . $project->file_path));
        }
        $project->delete();

        return redirect()->back()->with('success', 'Project deleted successfully.');
    }
}
