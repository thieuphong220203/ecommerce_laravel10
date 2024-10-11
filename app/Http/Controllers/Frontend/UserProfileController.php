<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    //
    public function index() :View {
        return view('frontend.dashboard.profile');
    }

    public function updateProfile(Request $request) :RedirectResponse {
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
                flash()->addSuccess("Load new image success");
            }else {
                flash()->addWarning("Cannot remove old image");
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

    public function updatePassword(Request $request) :RedirectResponse {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $request->user()->update([
            'password' => bcrypt($request->get('password')),
        ]);

        flash()->addSuccess("Password updated successfully");
        return redirect()->back();
    }
}
