<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\CourseVideo;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\VideoCompletion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /** -------------------------
     *  INDEX PAGE
     * ------------------------- */
    public function index()
    {
        // Check if logged-in user is admin
        if (Auth::user()->role === 'admin') {
            // Admin sees all records
            $courses = Course::with('trainer', 'videos')->latest()->get();

        }elseif(Auth::user()->role === 'student') {
            // Normal user sees only their records
            $courses = Course::with('trainer', 'videos')
                ->where('student_id', Auth::id())
                ->latest()
                ->get();
        }else{
            $courses = [];
        }
      
        return view('admin.courses.index', compact('courses'));
    }

    /** -------------------------
     *  CREATE PAGE
     * ------------------------- */
    public function create()
    {
        $trainers = User::where('role', 'trainer')->get();
        $students = User::where('role', 'student')->get();
        return view('admin.courses.create', compact('trainers','students'));
    }

    /** -------------------------
     *  STORE COURSE
     * ------------------------- */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title'        => 'required|string|max:255|unique:courses,title',
            'trainer_id'   => 'required|exists:users,id',
            'student_id'   => 'required|exists:users,id',
            'thumbnail'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'description'  => 'required|string',
            'videos.*.title' => 'nullable|string|max:255',
            'videos.*.file'  => 'nullable|mimes:mp4,avi,mov,wmv|max:51200', // 50MB
            'course_fee' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // ✅ Save thumbnail manually
        $thumbnailName = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/course_thumbnails'), $thumbnailName);
        }

        // ✅ Create Course
        $course = Course::create([
            'title'       => $request->title,
            'trainer_id'  => $request->trainer_id,
            'student_id'  => $request->student_id,
            'thumbnail'   => $thumbnailName,
            'description' => $request->description,
            'course_fee'  => $request->course_fee,
        ]);

        $students = is_array($request->student_id) ? $request->student_id : [$request->student_id];
        foreach ($students as $studentId) {
            \DB::table('course_enrollments')->insert([
                'course_id'   => $course->id,
                'student_id'  => $studentId,
                'status'      => 'Pending', // default status
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        $subtotal = $course->course_fee; // base course fee
        $discountPercent = 0;
        $discountAmount  = 0;

        $cgstPercent = 0;
        $cgstAmount  = 0;

        $sgstPercent = 0;
        $sgstAmount  = 0;

        $gstPercent = 0;
        $gstAmount  = 0;

        $convenienceFee = ($subtotal * 1) / 100; // Example: 1% fee
        $convenienceFeeAmount = ($subtotal * $convenienceFee) / 100;

        $grandTotal = $subtotal 
                    - $discountAmount 
                    + $cgstAmount 
                    + $sgstAmount 
                    + $gstAmount
                    + $convenienceFeeAmount;

        // Generate invoice number
        $invoiceNumber = 'INV-' . time() . '-' . rand(1000,9999);

        Invoice::create([
            'user_id'   => $request->student_id,
            'course_id' => $course->id,

            'invoice_number' => $invoiceNumber,
            'invoice_date'   => now(),
            'due_date'       => now()->addDays(7),

            'subtotal'         => $subtotal,
            'discount_percent' => $discountPercent,
            'discount_amount'  => $discountAmount,

            'cgst_percent' => $cgstPercent,
            'cgst_amount'  => $cgstAmount,

            'sgst_percent' => $sgstPercent,
            'sgst_amount'  => $sgstAmount,

            'gst_percent' => $gstPercent,
            'gst_amount'  => $gstAmount,

            'convenience_fee_percent' => $convenienceFee,
            'convenience_fee_amount' => $convenienceFeeAmount,

            'grand_total' => $grandTotal,

            'status' => 'unpaid',
        ]);

        // ✅ Save Videos (if any)
        if ($request->has('videos')) {
            foreach ($request->videos as $video) {
                if (!empty($video['title']) && isset($video['file'])) {
                    $file = $video['file'];
                    $videoName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/course_videos'), $videoName);

                    CourseVideo::create([
                        'course_id'  => $course->id,
                        'title'      => $video['title'],
                        'description' => $video['description'] ?? null,
                        'video_path' => $videoName,
                        'duration' => $video['duration'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    /** -------------------------
     *  EDIT PAGE
     * ------------------------- */
    public function edit($id)
    {
        $course = Course::with('videos')->findOrFail($id);
        $trainers = User::where('role', 'trainer')->get();
        $students = User::where('role', 'student')->get();
        return view('admin.courses.create', compact('course', 'trainers', 'students'));
    }

    /** -------------------------
     *  UPDATE COURSE
     * ------------------------- */
    public function update(Request $request, $id)
    {

        $course = Course::with('videos')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title'        => 'required|string|max:255',
            'trainer_id'   => 'required|exists:users,id',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description'  => 'required|string',
            'videos.*.title' => 'nullable|string|max:255',
            'videos.*.file'  => 'nullable|mimes:mp4,avi,mov,wmv|max:51200'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'title'       => $request->title,
            'trainer_id'  => $request->trainer_id,
            'student_id'  => $request->student_id,
            'description' => $request->description,
        ];

        // ✅ Replace thumbnail (manual delete & upload)
        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail && file_exists(public_path('uploads/course_thumbnails/' . $course->thumbnail))) {
                unlink(public_path('uploads/course_thumbnails/' . $course->thumbnail));
            }
            $file = $request->file('thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/course_thumbnails'), $filename);
            $data['thumbnail'] = $filename;
        }

        $course->update($data);

        /** ---- Update existing videos ---- */
        if ($request->has('existing_videos')) {
            foreach ($request->existing_videos as $videoId => $data) {
                $video = CourseVideo::find($videoId);
                if ($video) {
                    $video->title = $data['title'] ?? $video->title;
                    $video->description = $data['description'] ?? $video->description;

                    // Replace video file if new file uploaded 
                    if (isset($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
                        if ($video->video_path && file_exists(public_path('uploads/course_videos/' . $video->video_path))) {
                            unlink(public_path('uploads/course_videos/' . $video->video_path));
                        }
                        $file = $data['file'];
                        $videoName = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('uploads/course_videos'), $videoName);
                        $video->video_path = $videoName;
                    }

                    $video->duration = $data['duration'] ?? $video->duration;

                    $video->save();
                }
            }
        }

        /** ---- Add new videos ---- */
        if ($request->has('videos')) {
            foreach ($request->videos as $video) {
                if (!empty($video['title']) && isset($video['file'])) {
                    $file = $video['file'];
                    $videoName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/course_videos'), $videoName);

                    CourseVideo::create([
                        'course_id'  => $course->id,
                        'title'      => $video['title'],
                        'description' => $video['description'] ?? null,
                        'video_path' => $videoName,
                        'duration' => $video['duration'] ?? null,
                    ]);
                }
            }
        }

        /** ---- Delete videos marked for removal ---- */
        if ($request->has('delete_videos')) {
            foreach ($request->delete_videos as $videoId) {
                $video = CourseVideo::find($videoId);
                if ($video) {
                    if ($video->video_path && file_exists(public_path('uploads/course_videos/' . $video->video_path))) {
                        unlink(public_path('uploads/course_videos/' . $video->video_path));
                    }
                    $video->delete();
                }
            }
        }

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    /** -------------------------
     *  VIEW COURSE
     * ------------------------- */

    public function show($id)
    {
        $course = Course::with('trainer', 'videos', 'student')->findOrFail($id);
        return view('admin.courses.show', compact('course'));
    }

    /** -------------------------
     *  DELETE COURSE
     * ------------------------- */
    public function destroy($id)
    {
        $course = Course::with('videos')->findOrFail($id);

        // Delete thumbnail
        if ($course->thumbnail && file_exists(public_path('uploads/course_thumbnails/' . $course->thumbnail))) {
            unlink(public_path('uploads/course_thumbnails/' . $course->thumbnail));
        }

        // Delete videos
        foreach ($course->videos as $video) {
            if ($video->video_path && file_exists(public_path('uploads/course_videos/' . $video->video_path))) {
                unlink(public_path('uploads/course_videos/' . $video->video_path));
            }
            $video->delete();
        }

        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }

    public function markVideoComplete($videoId)
    {
        VideoCompletion::updateOrCreate(
            [
                'student_id' => auth()->id(),
                'video_id' => $videoId
            ],
            [
                'is_completed' => true
            ]
        );

        return response()->json(['status' => 'success']);
    }

}
