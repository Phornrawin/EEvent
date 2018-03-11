<?php

namespace EEvent\Http\Controllers;

use Auth;
use EEvent\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManagerStatic;

class ProfileController extends Controller
{

    public function show()
    {
        return view('profile.show', ['user' => Auth::user()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('profile.edit', ["user" => $user]);    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        if ($user->avatar != 'other.jpg') {
            $oldAvatar = public_path('uploads/avatars/' . $user->avatar);
            File::delete($oldAvatar);
        }
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = Carbon::now() . $user->name . '.' . $avatar->getClientOriginalExtension();
            $path = public_path('uploads/avatars/' . $filename);
            ImageManagerStatic::make($avatar)->resize(300, 300)->save($path);
            $user->avatar = $filename;
            $user->save();
        }
        return view('profile.show', ["user" => $user]);
    }
}