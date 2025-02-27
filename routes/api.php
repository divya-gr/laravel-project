<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;

Route::post('/upload', function (Request $request) {
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        // Store in the "uploads" directory inside "storage/app/public/"
        $path = $request->file('photo')->store('uploads', 'public');

        return response()->json([
            'message' => 'File uploaded successfully',
            'file_path' => asset('storage/' . $path),
        ]);
    }

    return response()->json(['error' => 'No file uploaded'], 400);
});

