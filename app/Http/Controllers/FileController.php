<?php

namespace App\Http\Controllers;

use App\Models\file;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:1024',
        ]);

        $file = $request->file('file')->store('files');

        $file = file::create([
            'name' => $request->file('file')->getClientOriginalName(),
            'path' => $file
        ]);

        return response()->json([
            'path' => $file
        ]);
    }

    public function download($id)
    {
        $file = file::findOrFail($id);

        return response()->download(storage_path('app/' . $file->path));
    }
}
