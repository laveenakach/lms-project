<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    public function index()
    {
        // Check if logged-in user is admin
        if (Auth::user()->role === 'admin') {
            // Admin sees all records
            $attendances = Attendance::with('user')->latest()->get();

        } else {
            // Normal user sees only their records
            $attendances = Attendance::with('user')
                ->where('user_id', Auth::id())
                ->latest()
                ->get();
        }

        return view('admin.attendance.index', compact('attendances'));
    }


    public function create()
    {
        $users = User::whereNotIn('role', ['admin'])->latest()->get();
        return view('admin.attendance.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'date' => 'required|date',
            'status' => 'required',
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendances.index')->with('success', 'Attendance added successfully!');
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $users = User::all();
        return view('admin.attendance.create', compact('attendance', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'date' => 'required|date',
            'status' => 'required',
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update($request->all());

        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully!');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return back()->with('success', 'Attendance deleted successfully!');
    }
}
