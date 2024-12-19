<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(Request $request)
    {
    }

    public function show(File $file): JsonResponse
    {
        return response()->json([
            'fileName' => $file->file_name,
            'uploaded' => true,
            'url' => $file->file_url,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $file = File::create([
                'file_name' => pathinfo($request->file('upload')?->getClientOriginalName(), PATHINFO_FILENAME),
                'extension' => $request->file('upload')?->getClientOriginalExtension(),
                'file' => $request->file('upload')?->store('editor/file', 'public'),
            ]);

            return response()->json([
                'fileName' => $file->file_name,
                'uploaded' => true,
                'url' => $file->file_url,
            ]);
        }

        return response()->json([
            'uploaded' => false,
        ]);
    }

    public function storeInStorage(Request $request): JsonResponse
    {
        $request->validate([
            'upload' => ['required']
        ]);
        if ($request->hasFile('upload')) {
            $file_name = pathinfo($request->file('upload')?->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->file('upload')?->getClientOriginalExtension();
            $file = $request->file('upload')?->store('recommendation/', 'public');

            return response()->json([
                'fileName' => $file_name,
                'uploaded' => true,
                'url' => $file,
                'extension' => $extension,
            ]);
        }

        return response()->json([
            'uploaded' => false,
        ]);
    }

    public function destroy(File $file)
    {
        if ($file->file) {
            $this->deleteFile($file->file);
        }

        $file->delete();
        toast('फाइल सफलतापूर्वक मेटियो', 'success');

        return back();
    }

    public function download(File $file)
    {
        return Storage::disk('public')->download($file->file, $file->file_name . $file->extension);
    }

    public function downloadFile()
    {

//        dd($_GET['file_url']);
        if (!empty($_GET['file_url']) && Storage::disk('public')->exists($_GET['file_url'])) {
            return Storage::disk('public')->download($_GET['file_url']);
        } else {
            toast('माफ गर्नुहोस् फाइल फेला परेन', 'error');
            return back();
        }
    }

    public function fileUpload(Request $request)
    {

        $file = $request->file('upload');
        $path = 'ckEditor/' . date("Y-m-d");
        $filename = $file->getClientOriginalName();
        $counter = 1;
        while (Storage::disk('public')->exists($path . $filename)) {
            $filename = $counter . '_' . $file->getClientOriginalName();
            $counter++;
        }

        $path = $file->storePubliclyAs($path, $filename, 'public');

        return response()->json([
            'url' => Storage::disk('public')->url($path)
        ]);
    }
}
