<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AssignmentSubmittedNotification;

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
            
            $assignments = Assignment::with([
                'trainer',
                'course.enrollments.student', // 🔥 REQUIRED
                'submissions'                  // 🔥 REQUIRED
            ])
            ->where('trainer_id', Auth::id())
            ->latest()
            ->get();

        } elseif (Auth::user()->role === 'student') {

            // Get all course IDs student is enrolled in
            $enrolledCourseIds = \DB::table('course_enrollments')
                ->where('student_id', Auth::id())
                ->pluck('course_id');

            // Show assignments for those courses
            $assignments = Assignment::with(['course', 'trainer'])
                ->whereIn('course_id', $enrolledCourseIds)
                ->latest()
                ->get();
        }

        return view('student.assignments.index', compact('assignments'));
    }

    public function create($id = null)
    {
        if (Auth::user()->role !== 'trainer') {
            abort(403, 'Unauthorized Access');
        }

        // If editing, fetch assignment. If creating, make a new one.
        $assignment = $id ? Assignment::findOrFail($id) : new Assignment();

        // Trainer should only see THEIR courses
        $courses = Course::where('trainer_id', Auth::id())->get();

        return view('student.assignments.create', compact('assignment', 'courses'));
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

        $data['course_id'] = $request->course_id;
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

    public function viewFile($id)
    {
        $assignment = Assignment::findOrFail($id);

        $isPaid = true;

        if (auth()->user()->role === 'student') {
            $isPaid = DB::table('course_enrollments')
                        ->where('student_id', auth()->id())
                        ->where('course_id', $assignment->course_id)
                        ->where('status', 'Approved')
                        ->exists();

            if (!$isPaid) {
                abort(403, "You must complete payment to access this assignment.");
            }
        }

        $filePath = public_path('uploads/assignments/'.$assignment->file_path);

        if (!file_exists($filePath)) {
            abort(404, "File not found.");
        }

        return response()->file($filePath);
    }

    public function uploadAssignment(Request $request, $assignmentId)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,zip|max:10240',
        ]);

        DB::transaction(function () use ($request, $assignmentId) {

            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/assignment_submissions'), $filename);

            // Save submission
            AssignmentSubmission::updateOrCreate(
                [
                    'assignment_id' => $assignmentId,
                    'student_id' => auth()->id(),
                ],
                [
                    'file_path' => $filename,
                ]
            );

            // 🔥 Update assignment status
            Assignment::where('id', $assignmentId)
                ->update(['status' => 'Submitted']);
        });

        // -------------------------------
        // Notify the trainer
        // -------------------------------
        $assignment = Assignment::find($assignmentId);
        $student = auth()->user();
        $message = "Student '".auth()->user()->name."' submitted '{$assignment->title}'";
        $trainer = User::where('id', $assignment->trainer_id)
            ->where('role', 'trainer')
            ->first();

        if ($trainer) {

            $trainer->notify(new AssignmentSubmittedNotification($assignment, $student));
            // Check if notification already exists to prevent duplicates
            $duplicate = DB::table('user_notifications')
                ->join('notifications', 'notifications.id', '=', 'user_notifications.notification_id')
                ->where('user_notifications.user_id', $trainer->id)
                ->where('notifications.message', $message)
                ->exists();

            if (!$duplicate) {
                // Insert notification
                $notificationId = DB::table('notifications')->insertGetId([
                    'title' => 'New Assignment Submission',
                    'message' => $message,
                    'target_role' => 'trainer',
                    'is_read' => 0,
                    'created_by' => auth()->id(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Attach to trainer
                DB::table('user_notifications')->insert([
                    'user_id' => $trainer->id,
                    'notification_id' => $notificationId,
                    'is_read' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return back()->with('success', 'Assignment submitted successfully');
    }

    public function viewSubmission($submissionId)
    {
        $user = auth()->user();

        $query = AssignmentSubmission::where('id', $submissionId);

        // Student can view ONLY own submission
        if ($user->role === 'student') {
            $query->where('student_id', $user->id);
        }

        $submission = $query->firstOrFail();

        $filePath = public_path('uploads/assignment_submissions/' . $submission->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->file($filePath);
    }

}
