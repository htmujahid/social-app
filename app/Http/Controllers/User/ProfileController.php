<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ProfileUpdateRequest;
use \App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $user = User::with('userMedia')->where('id', $request->user()->id)->first();

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
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

        return Redirect::route('profile.edit');
    }

    /**
     * Update the user's image.
     */
    public function updateImage(Request $request): RedirectResponse
    {
        $userMedia = UserMedia::where('user_id', $request->user()->id)->first();

        if ($userMedia) {
            $path = $userMedia->path;
            $disk = Storage::disk('public');
            if ($disk->exists($path)) {
                $disk->delete($path);
            }

            $userMedia->delete();
        }

        $request->validate([
            'user-media' => ['required', 'image'],
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
        $request->validate([
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
