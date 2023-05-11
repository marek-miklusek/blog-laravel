<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Services\UploadService;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    use UploadImage;

    protected $upload;
    protected $image;

    public function __construct(UploadService $upload, ImageService $image)
    {
        $this->upload = $upload;
        $this->image = $image;
    }

    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        
		$this->uploadImage($request->user(), $request->file('avatar'));

        $request->user()->save();

        return Redirect::route('profile.edit')->with('message', 'Profile was updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->user()->delete();

        session()->flash('message', 'Bye, bye :(');
        return redirect('/');
    }


    /**
     * Delete avatar
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);

        $user->file()->delete();
        File::deleteDirectory(public_path('profile-image/users/'.$id));

        return redirect()->route('profile.edit');
    }
}
