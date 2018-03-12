<?php

namespace EEvent\Http\Controllers;

use Auth;
use EEvent\Event;
use EEvent\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic;

class ProfileController extends Controller
{

    public function show()
    {
        $recent = Event::with(['category', 'organizer'])->orderBy('created_at', 'desc')->limit(6)->get();
        return view('profile.show', ['user' => Auth::user(), 'recent' => $recent]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', ["user" => $user]);
    }

    public function editBio()
    {
        $user = Auth::user();
        return view('profile.bio', ['user' => $user]);
    }

    public function updateBio(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'age' => 'numeric|between:1,130|',
            'tel_phone' => 'digits_between:10,12',
        ]);

        $user->profile()->update($data);
        return redirect()->route('profile.edit.bio')->with('success', 'Your Bio has been updated :)');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user()->makeVisible('password');
        if ($user != null) {
            $data = $request->validate([
                'name' => 'required|max:50',
                'email' => 'required'
            ]);
            $user->update($data);
            return redirect()->route('profile.edit')->with('success', 'Your account has been updated');
        }

//        $checkCur = Hash::check($_POST["currentPass"], $user->password);
//        if ($checkCur) {
//            if ($_POST["password"] == $_POST["retypeNewPass"] && $_POST["retypeNewPass"] != "" && $_POST["password"] != "") {
//                $data2 = $request->validate([
//                    'password' => 'required'
//                ]);
//                $data2['password'] = Hash::make($_POST["password"]);
//                $user->update($data2);
//                return redirect()->route('profile.show')->with('success', 'Your input wrong current password');
//            } else {
//                return redirect()->route('profile.edit', ['id' => $user->id])->with('alert1', 'Mismatch new password');
//            }
//        } else {
//            return redirect()->route('profile.edit')->with('alert2', 'Your input wrong current password');
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        Auth::logout();
        try {
            if ($user->delete()) {
                return redirect()->route('home')->with('global', 'Your account has been deleted!');
            }
        } catch (\Exception $e) {
            return back()->withErrors('msg', 'Something went wrong');
        }
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
            $filename = $user->name . '.' . $avatar->getClientOriginalExtension();
            $path = public_path('uploads/avatars/' . $filename);
            ImageManagerStatic::make($avatar)->resize(300, 300)->save($path);
            $user->avatar = $filename;
            $user->save();
        }
        return view('profile.show', ["user" => $user]);
    }
}