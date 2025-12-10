<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\CourseVideo;
use App\Models\Blog;
use App\Models\BlogCategory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function courses()
    {
        // Check if user is logged in
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                // Admin sees all courses
                $courses = Course::with('trainer', 'videos')->latest()->paginate(8);
            } elseif ($user->role === 'student') {
                // Student sees only their assigned courses
                $courses = Course::with('trainer', 'videos')
                    ->where('student_id', $user->id)
                    ->latest()
                    ->paginate(8);
            } else {
                // Other roles (e.g. trainer, guest)
                $courses = collect();
            }
        } else {
            // Guest user (not logged in)
            $courses = collect(); // empty collection
        }

        return view('frontend.courses', compact('courses'));
    }

    public function courseDetails($id)
    {
        // Find course with trainer & videos
        // $course = Course::with(['trainer', 'videos'])->findOrFail($id);
        $course = Course::with('trainer')->findOrFail($id);
        // Paginate videos separately (10 per page)
        $videos = $course->videos()->latest()->paginate(6);

        return view('frontend.course-details', compact('course', 'videos'));
    }

    public function dataScienceProgram()
    {
        return view('frontend.courses.data-science-ai-ml');
    }

    public function powerBiProgram()
    {
        return view('frontend.courses.powerbi-analytics');
    }

    public function placementProgram()
    {
        return view('frontend.courses.placement-assistance');
    }

    public function dataAnalytics()
    {
        return view('frontend.courses.data-analytics');
    }


    public function blog(Request $request)
    {
        $categories = BlogCategory::orderBy('name', 'asc')->get();
        $selectedCategory = null;
        // Filter blogs by category if category slug is present in URL
        if ($request->has('category')) {
            $selectedCategory = BlogCategory::where('name', $request->category)->first();

            if ($selectedCategory) {
                $blogs = Blog::where('category_id', $selectedCategory->id)
                    ->latest()
                    ->paginate(6);
            } else {
                $blogs = Blog::latest()->paginate(6);
            }
        } else {
            $blogs = Blog::latest()->paginate(6);
        }

        return view('frontend.blogs.index', compact('blogs', 'categories', 'selectedCategory'));
    }

    public function blogshow($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $relatedBlogs = Blog::where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->take(3)->get();

        return view('frontend.blogs.show', compact('blog', 'relatedBlogs'));
    }

    public function trainer_program()
    {
        return view('frontend.trainer_program');
    }



}
