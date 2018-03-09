<?php

namespace EEvent\Http\Controllers;

use Auth;
use EEvent\Attendee;
use File;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile.show', ['title' => Auth::user()->name, 'user' => Auth::user()]);
    }

    public function updateAvatar(Request $request)
    {
        $user = Auth::user();
        if ($user->avatar != 'default.jpg') {
            $oldAvatar = public_path('uploads/avatars/' . $user->avatar);
            File::delete($oldAvatar);
        }
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . $user->name . '.' . $avatar->getClientOriginalExtension();
            $path = public_path('uploads/avatars/' . $filename);
            ImageManagerStatic::make($avatar)->resize(300, 300)->save($path);
            $user->avatar = $filename;
            $user->save();
        }
        return view('profile.show', ["user" => $user]);
    }
}
