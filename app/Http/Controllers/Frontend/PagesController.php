<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Mail\ContactMail;
use Auth;
use Mail;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::orderby('id', 'desc')->where('status', 1)->get();
        $posts = Post::orderby('id', 'desc')->where('status', 1)->paginate(9);
        return view('frontend.pages.homepage', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function userLogin()
    {
        return view('frontend.auth-user.login');
    }

    /**
     * Display a listing of the resource.
     */
    public function contact()
    {
        return view('frontend.pages.static-pages.contact');
    }

    /**
     * Display a listing of the resource.
     */
    public function contactMail(Request $request)
    {
        $mailData = [
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::to('akramhoss392ain@gmail.com')->send( new ContactMail($mailData) );

        $notification = array (
            'message' => 'Thank You! We Have Received Your Mail',
            'alert-type' => 'Success',
        );
        return redirect()->back()->with($notification);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function storeComment(Request $request)
    {
        $comment = new Comment;

        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->message = $request->message;

        $comment->save();
        $notification = array (
            'message' => 'Comment send Successfully!',
            'alert-type' => 'info',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display a listing of the resource.
     */
    public function replyComment(Request $request, String $id)
    {
        $comment = new Comment;

        $comment->user_id   = Auth::user()->id;
        $comment->post_id   = $request->post_id;
        $comment->is_parent = $request->id;
        $comment->message   = $request->message;

        // dd($comment);

        $comment->save();
        $notification = array (
            'message' => 'Comment send Successfully!',
            'alert-type' => 'Success',
        );
        return redirect()->back()->with($notification);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posts = Post::orderby('id', 'desc')->where('category_id', $id)->where('status', 1)->get();
        if( !is_null( $posts ) ) {
            return view('frontend.pages.blogpost', compact('posts'));
        }
        else {
            // 404 Page not Found
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function postDetails(string $id)
    {
        Post::find($id)->increment('view_count');     // single post count

        $posts = Post::where('id', $id)->get();
        $comments = Comment::orderby('id', 'asc')->where('post_id', $id)->where('status', 1)->where('is_parent', 0)->get();
        if( !is_null( $posts ) ) {
            return view('frontend.pages.post_details', compact('posts', 'comments'));
        }
        else {
            // 404 Page not Found
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function search(Request $request){
        // Get the search value from the request
        // $search = $request->input('search');

        // // Search in the title and body columns from the posts table
        // $posts = Post::query()
        //     ->where('title', 'LIKE', "%{$search}%")
        //     ->orWhere('tags', 'LIKE', "%{$search}%")
        //     ->get();

        // // Return the search view with the resluts compacted
        // return view('frontend.pages.search_contentpage', compact('posts'));

        $search = $request['search'] ?? "";
        if ( $search != "" ) {
            # code...
            $posts = Post::where('title', 'LIKE', "%{$search}%")
            ->orWhere('tags', 'LIKE', "%{$search}%")
            ->get();

            return view('frontend.pages.search_contentpage', compact('posts'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
