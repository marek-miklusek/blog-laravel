<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as LaravelFile;

class FileController extends Controller
{
    public function destroy($id)
    {
        $file = File::findOrFail($id);

        // Remove from DB
        $file->delete();

        // Remove from disc
        LaravelFile::deleteDirectory(storage_path('posts/'.$file->post_id));

        return back();
    }


    public function download($id, $name)
    {
        $file = File::findOrFail($id);

        // Download file from storage/posts/...
		return response()->download(
			storage_path("posts/{$file->post_id}/{$file->filename}")
		);
    }
}
