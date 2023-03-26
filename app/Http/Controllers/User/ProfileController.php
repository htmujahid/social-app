<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\UserMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = User::with('userMedia')->where('id', $request->user()->id)->first();

        return view('profile.edit', [
            'user' => $user,
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

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's image.
     */
    public function updateImage(Request $request): RedirectResponse
    {
        $userMedia = UserMedia::where('user_id', $request->user()->id)->first();

        if ($userMedia) {
            // delete the old image
            $path = $userMedia->path;
            $disk = Storage::disk('public');
            if ($disk->exists($path)) {
                $disk->delete($path);
            }

            $userMedia->delete();
        }

        $request->validate([
            'user-media' => ['required', 'image', 'max:1024'],
        ]);

        $file = $request->file('user-media');

        $path = $file->store('users', 'public');
        
        UserMedia::create(
            [
                'user_id' => $request->user()->id,
                'path' => $path,
            ]
        );

        return Redirect::route('profile.edit')->with('status', 'profile-image-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
