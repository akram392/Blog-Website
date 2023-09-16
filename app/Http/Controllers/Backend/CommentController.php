<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Image;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::orderby('id', 'desc')->where('status', 1)->where('is_parent', 0)->get();
        return view('backend.pages.comment.manage', compact('comments'));
    }

     /**
     * Display a listing of the resource.
     */
    public function trash()
    {
        $comments = Comment::orderby('id', 'asc')->where('status', 2)->get();
        return view('backend.pages.comment.trash', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = Comment::find($id);
        if ( !is_null($comment) ) {
            # code...
            return view('backend.pages.comment.edit', compact('comment'));
        }
        else {
            # code...
            // 404 not found
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comment = Comment::find($id);
        if ( !is_null($comment) ) {
            # code...
            $comment->message = $request->message;
            $comment->status  = $request->status;


            $comment->save();
            $notification = array (
                'message' => 'Comment Information Updated!',
                'alert-type' => 'info',
            );
            return redirect()->route('comment.manage')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        if( !is_null( $comment ) ) {
            // Image Deleted

            // Content Deleted
            // $brand->delete();

            // Soft Deleted
            $comment->status = 2;
            $comment->save();
            $notification = array (
                'message' => 'Comment Removed!',
                'alert-type' => 'error',
            );
            return redirect()->route('comment.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }
}
