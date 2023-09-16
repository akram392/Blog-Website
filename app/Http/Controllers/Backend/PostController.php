<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Image;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'asc')->where('status', 1)->paginate(5);
        return view('backend.pages.post.manage', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pcategories = Category::orderBy('name', 'asc')->where('is_parent', 0)->get();
        return view('backend.pages.post.create', compact('pcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post;

        $post->title            = $request->title;
        $post->slug             = Str::slug($request->title);
        $post->description      = $request->description;
        $post->category_id      = $request->category_id;
        $post->tags             = $request->tags;
        $post->status           = $request->status;
        $post->posted_by        = Auth::user()->id;
        // $post->view_count       = $request->view_count;

        if ($request->image) {                                                   // find img
            # code...
            // Delete Old Image
            if (File::exists('images/post/' . $post->image)) {
                # code...
                File::delete('images/post/' . $post->image);
            }

            $image = $request->file('image');                                    // received img
            $img = time() . '-br.' . $image->getClientOriginalExtension();       // make img name
            $location = public_path('images/post/' . $img);                  // find img location
            Image::make($image)->save($location);                                // save img location
            $post->image = $img;                                             // save img
        }


        $post->save();

        $notification = array (
            'message' => 'Post Published Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('post.manage')->with($notification);
        // return redirect()->route('post.manage');
    }

    /**
     * Display the specified resource.
     */
    public function trash()
    {
        $posts = Post::orderBy('id', 'asc')->where('status', 2)->get();
        return view('backend.pages.post.trash', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);

        if( !is_null( $post ) ) {
            $pcategories = Category::orderBy('name', 'asc')->where('is_parent', 0)->get();
            return view('backend.pages.post.edit', compact('post', 'pcategories'));
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
        $post = Post::find($id);

        if( !is_null( $post ) ) {
            $post->title            = $request->title;
            $post->slug             = Str::slug($request->title);
            $post->description      = $request->description;
            $post->category_id      = $request->category_id;
            $post->tags             = $request->tags;
            $post->status           = $request->status;
            $post->posted_by        = Auth::user()->id;
            // $post->view_count       = $request->view_count;

            if ($request->image) {                                                   // find img
                # code...
                // Delete Old Image
                if (File::exists('images/post/' . $post->image)) {
                    # code...
                    File::delete('images/post/' . $post->image);
                }

                $image = $request->file('image');                                    // received img
                $img = time() . '-br.' . $image->getClientOriginalExtension();       // make img name
                $location = public_path('images/post/' . $img);                  // find img location
                Image::make($image)->save($location);                                // save img location
                $post->image = $img;                                             // save img
            }


            $post->save();

            $notification = array (
                'message' => 'Post Published Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->route('post.manage')->with($notification);
            // return redirect()->route('post.manage');
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
        $post = Post::find($id);
        if( !is_null( $post ) ) {
            // Image Deleted

            // Content Deleted
            // $brand->delete();

            // Soft Deleted
            $post->status = 2;
            $post->save();
            $notification = array (
                'message' => 'Post Removed!',
                'alert-type' => 'error',
            );
            return redirect()->route('post.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }
}
