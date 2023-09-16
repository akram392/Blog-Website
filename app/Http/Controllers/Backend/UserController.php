<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Image;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->where('status', 1)->get();
        return view('backend.pages.user.manage', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User;

        $user->name                   = $request->name;
        $user->email                  = $request->email;
        $user->phone                  = $request->phone;
        $user->address_line1          = $request->address_line1;
        $user->address_line2          = $request->address_line2;
        $user->country_name           = $request->country_name;
        $user->zipCode                = $request->zipCode;
        $user->is_admin               = $request->is_admin;
        $user->status                 = $request->status;

        if ($request->image) {                                                      // find img
            # code...
            // Delete Old Image
            if (File::exists('images/user/' . $user->image)) {
                # code...
                File::delete('images/user/' . $user->image);
            }

            $image = $request->file('image');                                      // received img
            $img = time() . '-br.' . $image->getClientOriginalExtension();        // make img name
            $location = public_path('images/user/' . $img);                  // find img location
            Image::make($image)->save($location);                               // save img location
            $user->image = $img;                                               // save img
        }

        // dd($brand);
        // exit();
        $user->save();
        $notification = array (
            'message' => 'User Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('user.manage')->with($notification);
        // return redirect()->route('user.manage');
    }

    /**
     * Display the specified resource.
     */
    public function trash()
    {
        $users = User::orderBy('name', 'asc')->where('status', 0)->get();
        return view('backend.pages.user.trash', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if( !is_null( $user ) ) {
            return view('backend.pages.user.edit', compact('user'));
        }
        else {
            // 404 Page not Found
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if( !is_null( $user ) ) {
            $user->name                   = $request->name;
            $user->email                  = $request->email;
            $user->phone                  = $request->phone;
            $user->address_line1          = $request->address_line1;
            $user->address_line2          = $request->address_line2;
            $user->country_name           = $request->country_name;
            $user->zipCode                = $request->zipCode;
            $user->is_admin               = $request->is_admin;
            $user->status                 = $request->status;

            if ($request->image) {                                                      // find img
                # code...
                // Delete Old Image
                if (File::exists('images/user/' . $user->image)) {
                    # code...
                    File::delete('images/user/' . $user->image);
                }

                $image = $request->file('image');                                      // received img
                $img = time() . '-br.' . $image->getClientOriginalExtension();        // make img name
                $location = public_path('images/user/' . $img);                  // find img location
                Image::make($image)->save($location);                               // save img location
                $user->image = $img;                                               // save img
            }

            // dd($brand);
            // exit();
            $user->save();
            $notification = array (
                'message' => 'User Added Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->route('user.manage')->with($notification);
            // return redirect()->route('user.manage');
        }
        else {
            // 404 Page not Found
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if( !is_null( $user ) ) {
            // Image Deleted

            // Content Deleted
            // $user->delete();

            // Soft Deleted
            $user->status = 0;
            $user->save();
            $notification = array (
                'message' => 'User Removed!',
                'alert-type' => 'error',
            );
            return redirect()->route('user.manage')->with($notification);
            // return redirect()->route('user.manage');
        }
        else {
            // 404 Page not Found
        }
    }
}
