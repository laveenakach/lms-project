<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckCoursePaid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role !== 'student') {
            return $next($request); // Admin/Trainer bypass
        }

        // Get the course ID dynamically from route parameters
        $courseId = $request->route('course') ?? $request->route('id');

        if (! $courseId) {
            // No course ID in route, skip check
            return $next($request);
        }

        $isPaid = \DB::table('course_enrollments')
            ->where('student_id', Auth::id())
            ->where('course_id', $courseId)
            ->where('status', 'Approved')
            ->exists();

        if (! $isPaid) {
            return redirect()->route('student.invoices.index')
                ->with('error', 'You must pay the course fee to access this course.');
        }

        return $next($request);
    }
}
