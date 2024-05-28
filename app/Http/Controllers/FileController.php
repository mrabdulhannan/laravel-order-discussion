<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        // Get all files from the 'uploads' directory
        $files = Storage::disk('public')->files('uploads');

        return view('files.index', compact('files'));
    }

    public function destroy($file)
    {
        // Decode the file path if necessary
        $filePath = 'uploads/' . $file;
        
        // Delete the file from the 'uploads' directory
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return response()->json(['success' => 'File deleted successfully']);
        }

        return response()->json(['error' => 'File not found'], 404);
    }
}
