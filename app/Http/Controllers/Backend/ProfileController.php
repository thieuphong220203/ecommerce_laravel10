<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    //
    public function index(): View {
        return view('admin.profile.index');
    }

    public function updateProfile(Request $request) : RedirectResponse  {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::id()],
            'image' => ['image', 'max:2048'],
        ]);

        $user = Auth::user();
        if($request->hasFile('image')) {
            $isFile = File::exists(public_path($user->image));
            if($isFile) {
                File::delete(public_path($user->image));
            }

            //lay file tu html
            $image = $request->file('image');
            //tao ten moi cho file
            $imageName = rand().'_'.$image->getClientOriginalName();
            //di chuyen file den public/uploads
            $image->move(public_path('uploads'), $imageName);

            //tao path luu vao db
            $path = "uploads/".$imageName;
            $user->image = $path;
        }
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();
        flash()->addSuccess("Profile updated successfully");
        return redirect()->back();
    }

    public function updatePassword(Request $request): RedirectResponse {
        $request->validate([
            'current_password' => ['required', 'current_password'], //auto check password
            'password' => ['required', 'min:8', 'confirmed'], //auto check if the name is password_confirmation
        ]);
         $request->user()->update([
             'password' => bcrypt($request->get('password')),
         ]);
         flash()->addSuccess("Password updated successfully");
         return redirect()->back();
    }

}
