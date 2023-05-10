<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File as LaravelFile;

class FileController extends Controller
{
    public function download($id, $name)
    {
        $file = File::findOrFail($id);

        // Download file from storage/posts/...
		return response()->download(
			storage_path("posts/$file->fileable_id/$file->filename")
		);
    }


    public function destroy($id)
    {
        $file = File::findOrFail($id);

        // Remove from DB
        $file->delete();

        // Remove file from storage folder
        LaravelFile::deleteDirectory(storage_path('posts/'.$file->post_id));

        // Remove image from public folder
        LaravelFile::deleteDirectory(public_path('post-image/posts/'.$file->fileable_id));

        return back();
    }
}
