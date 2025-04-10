<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    // Submit (store)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_paths' => 'nullable|array',
            'image_paths.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'file_path' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle file uploads
        $validated['image_path'] = $request->file('image_path')->store('images');
        if ($request->has('image_paths')) {
            $validated['image_paths'] = json_encode(array_map(function ($file) {
                return $file->store('images');
            }, $request->file('image_paths')));
        }
        $validated['file_path'] = $request->file('file_path')->store('files');

        Registration::create($validated);

        return response()->json(['message' => 'Registration created successfully.']);
    }

    // Tampilkan (index)
    public function index()
    {
        $registrations = Registration::all();
        return view('COBA.list', compact('registrations'));
    }

    // Hapus (destroy)
    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return response()->json(['message' => 'Registration deleted successfully.']);
    }

    // Edit (show)
    public function show($id)
    {
        $registration = Registration::findOrFail($id);
        return response()->json($registration);
    }

    // Update
    public function update(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);

        $validated = $request->validate([
            'description' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_paths' => 'nullable|array',
            'image_paths.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('images');
        }
        if ($request->has('image_paths')) {
            $validated['image_paths'] = json_encode(array_map(function ($file) {
                return $file->store('images');
            }, $request->file('image_paths')));
        }
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('files');
        }

        $registration->update($validated);

        return response()->json(['message' => 'Registration updated successfully.']);
    }
}