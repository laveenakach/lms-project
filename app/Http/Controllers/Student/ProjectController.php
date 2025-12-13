<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Course;
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
            // $projects = Project::with(['student', 'trainer'])
            //     ->where('student_id', Auth::id())
            //     ->latest()
            //     ->get();
            // Get all course IDs student is enrolled in
            $enrolledCourseIds = \DB::table('course_enrollments')
                ->where('student_id', Auth::id())
                ->pluck('course_id');

            // Show assignments for those courses
            $projects = Project::with(['course', 'trainer'])
                ->whereIn('course_id', $enrolledCourseIds)
                ->latest()
                ->get();
        }

        return view('student.projects.index', compact('projects'));
    }

    public function create($id = null)
    {
        if (Auth::user()->role !== 'trainer') {
            abort(403, 'Unauthorized Access');
        }

        // If editing, fetch project. If creating, make a new one.
        $project = $id ? Project::findOrFail($id) : new Project();

        // Trainer should only see THEIR courses
        $courses = Course::where('trainer_id', Auth::id())->get();

        return view('student.projects.create', compact('project', 'courses'));
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

        $data['course_id'] = $request->course_id;
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

    public function viewFile($id)
    {
        $project = Project::findOrFail($id);

        $isPaid = true;

        if (auth()->user()->role === 'student') {
            $isPaid = DB::table('course_enrollments')
                        ->where('student_id', auth()->id())
                        ->where('course_id', $project->course_id)
                        ->where('status', 'Approved')
                        ->exists();

            if (!$isPaid) {
                abort(403, "You must complete payment to access this project.");
            }
        }

        $filePath = public_path('uploads/Projects/'.$project->file_path);

        if (!file_exists($filePath)) {
            abort(404, "File not found.");
        }

        return response()->file($filePath);
    }
}
