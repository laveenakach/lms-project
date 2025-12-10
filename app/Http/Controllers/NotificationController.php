<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class NotificationController extends Controller
{
    public function index()
    {
        // Admin sees all
        if (Auth::user()->role === 'admin') {
            $notifications = Notification::latest()->get();
        } else {
            // Trainer or Student sees only relevant ones
            $notifications = Notification::latest()
                ->get();
        }

        return view('notifications.index', compact('notifications'));
    }

    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'date' => 'nullable|date',
            'attachment' => 'nullable|file|mimes:pdf,docx,jpg,png',
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/notifications'), $filename);
            $data['attachment'] = $filename;
        }

        $data['created_by'] = Auth::id();

        $notification = Notification::create($data);

        // Attach to all trainers and students
        $users = User::whereIn('role', ['trainer', 'student'])->pluck('id');

        foreach ($users as $userId) {
            DB::table('user_notifications')->insert([
                'user_id' => $userId,
                'notification_id' => $notification->id,
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('notifications.index')->with('success', 'Notification created successfully!');
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->attachment && file_exists(public_path('uploads/notifications/' . $notification->attachment))) {
            unlink(public_path('uploads/notifications/' . $notification->attachment));
        }

        $notification->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully!');
    }

    public function fetch()
    {
        $user = Auth::user();

        $notifications = $user->notifications()
            ->orderBy('notifications.created_at', 'desc')
            ->take(10)
            ->get()
            ->map(function ($n) {
                return [
                    'id' => $n->id,
                    'title' => $n->title,
                    'description' => $n->description,
                    'is_read' => $n->pivot->is_read,
                    'created_at' => $n->created_at->diffForHumans(),
                ];
            });

        $unread_count = $user->notifications()->wherePivot('is_read', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unread_count,
        ]);
    }

    public function markAsRead($id)
    {
        $user = Auth::user();
        $user->notifications()->updateExistingPivot($id, ['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
