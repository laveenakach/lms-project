<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    
     // List page
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $certifications = Certification::with('student')->latest()->get();
        } else {
            // Students see only their own certificates
            $certifications = Certification::where('student_id', Auth::id())->latest()->get();
        }

        return view('admin.certifications.index', compact('certifications'));
    }

    // Create page
    public function create()
    {
        $users = User::where('role', 'student')->get();
        return view('admin.certifications.create', compact('users'));
    }

    // Store new certification
    public function store(Request $request)
    {

        // echo "<pre>";
        // print_r($request->all());
        // die;
        $request->validate([
            'student_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'issued_date' => 'nullable|date',
            'file_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);


        $data = [
            'student_id' => $request->student_id,
            'title' => $request->title,
            'description' => $request->description,
            'issued_date' => $request->issued_date,
        ];

        // Handle file upload (manual public/uploads/certifications)
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/certifications'), $filename);
            $data['file_path'] = $filename;
        }

        Certification::create($data);

        return redirect()->route('certifications.index')->with('success', 'Certification added successfully.');
    }

    // Edit
    public function edit($id)
    {
        $certification = Certification::findOrFail($id);
        $users = User::where('role', 'student')->get();

        return view('admin.certifications.create', compact('certification', 'users'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $certification = Certification::findOrFail($id);

        $request->validate([
            'student_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'issued_date' => 'nullable|date',
            'file_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $data = [
            'student_id' => $request->student_id,
            'title' => $request->title,
            'description' => $request->description,
            'issued_date' => $request->issued_date,
        ];

        // Replace existing file if new one uploaded
        if ($request->hasFile('file_path')) {
            if ($certification->file_path && file_exists(public_path('uploads/certifications/' . $certification->file_path))) {
                unlink(public_path('uploads/certifications/' . $certification->file_path));
            }
            $file = $request->file('file_path');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/certifications'), $filename);
            $data['file_path'] = $filename;
        }

        $certification->update($data);

        return redirect()->route('certifications.index')->with('success', 'Certification updated successfully.');
    }

    // Delete
    public function destroy($id)
    {
        $certification = Certification::findOrFail($id);

        if ($certification->file_path && file_exists(public_path('uploads/certifications/' . $certification->file_path))) {
            unlink(public_path('uploads/certifications/' . $certification->file_path));
        }

        $certification->delete();

        return redirect()->back()->with('success', 'Certification deleted successfully.');
    }

}
