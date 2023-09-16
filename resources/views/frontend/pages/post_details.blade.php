@extends('frontend.layout.template')

@section('page-title')
    <title>Blog 3 Columns | Blog Site</title>
@endsection

@section('body-css')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" > --}}
@endsection

@section('body-content')
    <div role="main" class="main">

        <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 align-self-center p-static order-2 text-center">

                        <h1 class="text-dark font-weight-bold text-8">Post Right Sidebar</h1>
                        <span class="sub-title text-dark">Check out our Latest News!</span>
                    </div>

                    <div class="col-md-12 align-self-center order-1">

                        <ul class="breadcrumb d-block text-center">
                            <li><a href="{{ route('homepage') }}">Home</a></li>
                            <li class="active">Blog</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <div class="container py-4">

            <div class="row">
                <div class="col-lg-3 order-lg-2">
                    <aside class="sidebar">
                        <form action="{{ route('search') }}" method="GET">
                            {{-- @csrf --}}
                            <div class="input-group mb-3 pb-1">
                                <input class="form-control text-1" placeholder="Search..." name="search" id="s" type="search" required="required" autocomplete="off">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-dark text-1 p-2"><i class="fas fa-search m-2"></i></button>
                                </span>
                            </div>
                        </form>
                        <h5 class="font-weight-bold pt-4">Categories</h5>
                        <ul class="nav nav-list flex-column mb-5">
                            @foreach ( App\Models\Category::orderBy('name', 'asc')->where('is_parent', 0)->get() as $pCategory)
                                <li class="nav-item">
                                    @php $i=0; @endphp
                                    <a class="nav-link active" href="{{ route('blogpage', $pCategory->id) }}">{{ $pCategory->name }} (
                                            @foreach ( App\Models\Post::where('status', 1)->get() as $post )
                                                @if ( $post->category_id == $pCategory->id )
                                                    @php $i++; @endphp
                                                @endif
                                            @endforeach
                                            {{$i}}
                                        )
                                    </a>
                                    <ul>
                                        @foreach ( App\Models\Category::orderBy('name', 'asc')->where('is_parent', $pCategory->id)->get() as $childCategory)
                                            <li class="nav-item">
                                                @php $j=0; @endphp
                                                <a class="nav-link" href="{{ route('blogpage', $childCategory->id) }}">{{ $childCategory->name }} (
                                                        @foreach ( App\Models\Post::where('status', 1)->get() as $post )
                                                            @if ( $post->category_id == $childCategory->id )
                                                                @php $j++; @endphp
                                                            @endif
                                                        @endforeach
                                                        {{$j}}
                                                    )
                                                </a>
                                            </li>
                                            {{-- @php $i++; @endphp --}}
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tabs tabs-dark mb-4 pb-2">
                            <ul class="nav nav-tabs">
                                <li class="nav-item active"><a class="nav-link show active text-1 font-weight-bold text-uppercase" href="#popularPosts" data-toggle="tab">Popular</a></li>
                                <li class="nav-item"><a class="nav-link text-1 font-weight-bold text-uppercase" href="#recentPosts" data-toggle="tab">Recent</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="popularPosts">
                                    <ul class="simple-post-list">
                                        @foreach ( App\Models\Post::orderby('view_count', 'desc')->where('status', 1)->limit(3)->get() as $post )
                                            <li>
                                                <div class="post-image">
                                                    <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                                        @if ( !is_null($post->image) )
                                                            <a href="{{ route('post-details', $post->id) }}">
                                                                <img src="{{ asset('images/post/' . $post->image ) }}" width="50" height="50" alt="" />
                                                            </a>
                                                        @else
                                                            <a href="#">
                                                                <img src="{{ asset('frontend/img/blog/square/blog-24.jpg') }}" width="50" height="50" alt="" />
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="post-info">
                                                    <a href="{{ route('post-details', $post->id) }}">{{ substr($post->title, 0, 20) }}</a>
                                                    <div class="post-meta">
                                                        {{ date('M j, Y', strtotime($post->created_at)) }}
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                        {{-- <li>
                                            <div class="post-image">
                                                <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                                    <a href="blog-post.html">
                                                        <img src="img/blog/square/blog-11.jpg" width="50" height="50" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-info">
                                                <a href="blog-post.html">Nullam Vitae Nibh Un Odiosters</a>
                                                <div class="post-meta">
                                                     Nov 10, 2020
                                                </div>
                                            </div>
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="tab-pane" id="recentPosts">
                                    <ul class="simple-post-list">
                                        @foreach ( App\Models\Post::orderby('id', 'desc')->where('status', 1)->limit(3)->get() as $post )
                                            <li>
                                                <div class="post-image">
                                                    <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                                        @if ( !is_null($post->image) )
                                                            <a href="{{ route('post-details', $post->id) }}">
                                                                <img src="{{ asset('images/post/' . $post->image ) }}" width="50" height="50" alt="" />
                                                            </a>
                                                        @else
                                                            <a href="#">
                                                                <img src="{{ asset('frontend/img/blog/square/blog-24.jpg') }}" width="50" height="50" alt="" />
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="post-info">
                                                    <a href="{{ route('post-details', $post->id) }}">{{ substr($post->title, 0, 20) }}</a>
                                                    <div class="post-meta">
                                                        {{ date('M j, Y', strtotime($post->created_at)) }}
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <h5 class="font-weight-bold pt-4">About Us</h5>
                        <p>
                            @foreach ( $posts as $post )
                                {{ substr($post->description, 0, 150) }}
                            @endforeach
                        </p>
                        <h5 class="font-weight-bold pt-4">Latest from Facebook</h5>
                        <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-width="255" data-height="300" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
                        {{-- <div id="tweet" class="twitter mb-4" data-plugin-tweets data-plugin-options="{'username': 'oklerthemes', 'count': 2}">
                            <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-width="255" data-height="300" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
                        </div>
                        <div id="instafeedNoMargins" class="mb-4 pb-1"></div> --}}
                        <h5 class="font-weight-bold pt-4 mb-2">Tags</h5>
                        <div class="mb-3 pb-1">
                            @foreach ( App\Models\Post::all() as $post )

                                @php
                                    $values = explode(",",$post->tags);
                                @endphp

                                @if(in_array("$post->tags", $values))
                                    {{ $post->tags}}
                                @endif

                                @foreach($values as $tag)
                                    {{-- @foreach ($values as $value)
                                        @if ( $tag != $value )
                                            <span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">{{ $tag }}</span>
                                        @endif
                                    @endforeach --}}
                                    <span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">{{ $tag }}</span>
                                    {{-- <a href="{{ route('post-details', $post->id) }}"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">{{ $tag }}</span></a> --}}
                                @endforeach

                            @endforeach
                            {{-- <a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">design</span></a>
                            <a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">brands</span></a>
                            <a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">video</span></a>
                            <a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">business</span></a>
                            <a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">travel</span></a> --}}
                        </div>

                    </aside>
                </div>
                <div class="col-lg-9 order-lg-1">
                    <div class="blog-posts single-post">

                        <article class="post post-large blog-single-post border-0 m-0 p-0">
                            @foreach ( $posts as $post )

                                <div class="post-image ml-0">
                                    @if ( !is_null($post->image) )
                                        <img src="{{ asset('images/post/' . $post->image ) }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                                    @else
                                        <img src="{{ asset('frontend/img/blog/wide/blog-11.jpg') }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                                    @endif
                                </div>

                                <div class="post-date ml-0">
                                    <span class="day">{{ date('jS', strtotime($post->created_at)) }}</span>
                                    <span class="month">{{ date('M', strtotime($post->created_at)) }}</span>
                                </div>

                                <div class="post-content ml-0">

                                    <h2 class="font-weight-bold"><a href="#">{{ $post->title }}</a></h2>

                                    <div class="post-meta">
                                        <span><i class="far fa-user"></i> By <a href="{{ route('blogpage', $post->posted_by) }}">{{ $post->user->name }}</a> </span>
                                        <span><i class="far fa-folder"></i> <a href="{{ route('blogpage', $post->category_id) }}">{{ $post->category->name }}</a></span>
                                        <span><i class="far fa-comments"></i> <a href="#">
                                            @php $i=0; @endphp
                                            @foreach ( App\Models\comment::where('post_id', $post->id)->where('status', 1)->get() as $count )
                                                @php $i++; @endphp
                                            @endforeach
                                            {{$i;}}
                                            Comments
                                        </a>
                                        </span>
                                    </div>

                                    <p>{{ $post->description }}</p>

                                    <div class="post-block mt-5 post-share">
                                        <h4 class="mb-3">Share this Post</h4>
                                        <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="" data-size="">
                                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a>
                                        </div>

                                        <!-- AddThis Button BEGIN -->
                                        <div class="addthis_toolbox addthis_default_style ">
                                            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                            <a class="addthis_button_tweet"></a>
                                            <a class="addthis_button_pinterest_pinit"></a>
                                            <a class="addthis_counter addthis_pill_style"></a>
                                        </div>
                                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50faf75173aadc53"></script>
                                        <!-- AddThis Button END -->

                                    </div>

                                    {{-- <div class="post-block mt-4 pt-2 post-author">
                                        <h4 class="mb-3">Author</h4>
                                        <div class="img-thumbnail img-thumbnail-no-borders d-block pb-3">
                                            @if ( !is_null($post->user->image) )
                                                <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                    <img class="" alt="" src="{{ asset('images/user/' . $post->user->image ) }}">
                                                </div>
                                            @else
                                                <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                    <img class="" alt="" src="{{ asset('frontend/img/avatars/avatar.jpg') }}">
                                                </div>
                                            @endif
                                        </div>
                                        <p><strong class="name"><a href="#" class="text-4 pb-2 pt-2 d-block">{{ $post->user->name }}</a></strong></p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui. </p>
                                    </div> --}}

                                    <div id="comments" class="post-block mt-5 post-comments">
                                        <h4 class="mb-3">Comments (
                                                @php $i=0; @endphp
                                                @foreach ( App\Models\comment::where('post_id', $post->id)->where('status', 1)->get() as $count )
                                                    @php $i++; @endphp
                                                @endforeach
                                                {{$i;}}
                                            )
                                        </h4>

                                        <ul class="comments">

                                            @if ( $comments->count() > 0 )
                                                @foreach ( $comments as $comment )
                                                    <li>
                                                        <div class="comment">
                                                            @if ( !is_null($comment->user->image) )
                                                                <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                                    <img class="avatar" alt="" src="{{ asset('images/user/' . $comment->user->image ) }}">
                                                                </div>
                                                            @else
                                                                <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                                    <img class="avatar" alt="" src="{{ asset('frontend/img/avatars/avatar-2.jpg') }}">
                                                                </div>
                                                            @endif
                                                            <div class="comment-block">
                                                                <div class="comment-arrow"></div>
                                                                <span class="comment-by">
                                                                    <strong>{{ $comment->user->name }}</strong>
                                                                    <span class="float-right">
                                                                        @if ( Auth::check() )
                                                                            <span> <a href="" data-bs-toggle="modal" data-bs-target="#replyComment{{ $comment->id }}"><i class="fas fa-reply"></i> Reply</a></span>
                                                                        @else
                                                                            <span> <a href=""><i class="fas fa-reply"></i> Reply</a></span>
                                                                        @endif

                                                                    </span>
                                                                </span>
                                                                <p>{{ $comment->message }}</p>
                                                                <span class="date float-right">{{ date('F j, Y \a\t h:i a', strtotime($comment->created_at)) }}</span>
                                                            </div>
                                                        </div>
                                                        <!-- staticBackdrop Modal -->
                                                        <div class="modal fade" id="replyComment{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">

                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Send reply message</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    <form action="{{ route('reply.comment', $comment->id) }}" method="POST">
                                                                        @csrf

                                                                        <input type="hidden" class="form-control" value="{{ $comment->post_id }}" name="post_id">
                                                                        <div class="mb-3">
                                                                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                                            <input type="text" value="{{ $comment->user->name }}" class="form-control" id="recipient-name" readonly>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="message" class="col-form-label">Message:</label>
                                                                            <textarea class="form-control" name="message" id="message" required></textarea>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Send message</button>
                                                                        </div>
                                                                    </form>
                                                                    </div>
                                                                    {{-- <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-primary">Send message</button>
                                                                    </div> --}}
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <ul class="comments reply">
                                                            @foreach ( App\Models\Comment::orderby('id', 'asc')->where('status', 1)->where('is_parent', $comment->id)->get() as $childComment )
                                                                <li>
                                                                    <div class="comment">
                                                                        @if ( !is_null($childComment->user->image) )
                                                                            <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                                                <img class="avatar" alt="" src="{{ asset('images/user/' . $childComment->user->image ) }}">
                                                                            </div>
                                                                        @else
                                                                            <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                                                <img class="avatar" alt="" src="{{ asset('frontend/img/avatars/avatar-2.jpg') }}">
                                                                            </div>
                                                                        @endif
                                                                        <div class="comment-block">
                                                                            <div class="comment-arrow"></div>
                                                                            <span class="comment-by">
                                                                                <strong>{{ $childComment->user->name }}</strong>
                                                                                {{-- <span class="float-right">
                                                                                    <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                                                                                </span> --}}
                                                                            </span>
                                                                            <p>{{ $childComment->message }}</p>
                                                                            <span class="date float-right">{{ date('F j, Y \a\t h:i a', strtotime($childComment->created_at)) }}</span>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            @else
                                                <div class="col-lg-12">
                                                    <div class="alert alert-info">No Comment Found in this Post.</div>
                                                </div>
                                            @endif


                                            {{-- <li>
                                                <div class="comment">
                                                    <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                        <img class="avatar" alt="" src="img/avatars/avatar.jpg">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-arrow"></div>
                                                        <span class="comment-by">
                                                            <strong>John Doe</strong>
                                                            <span class="float-right">
                                                                <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                                                            </span>
                                                        </span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        <span class="date float-right">January 12, 2020 at 1:38 pm</span>
                                                    </div>
                                                </div>
                                            </li> --}}

                                            {{-- <li>
                                                <div class="comment">
                                                    <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                        <img class="avatar" alt="" src="img/avatars/avatar-2.jpg">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-arrow"></div>
                                                        <span class="comment-by">
                                                            <strong>John Doe</strong>
                                                            <span class="float-right">
                                                                <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                                                            </span>
                                                        </span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.</p>
                                                        <span class="date float-right">January 12, 2020 at 1:38 pm</span>
                                                    </div>
                                                </div>

                                                <ul class="comments reply">
                                                    <li>
                                                        <div class="comment">
                                                            <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                                <img class="avatar" alt="" src="img/avatars/avatar-3.jpg">
                                                            </div>
                                                            <div class="comment-block">
                                                                <div class="comment-arrow"></div>
                                                                <span class="comment-by">
                                                                    <strong>John Doe</strong>
                                                                    <span class="float-right">
                                                                        <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                                                                    </span>
                                                                </span>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae.</p>
                                                                <span class="date float-right">January 12, 2020 at 1:38 pm</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="comment">
                                                            <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                                <img class="avatar" alt="" src="img/avatars/avatar-4.jpg">
                                                            </div>
                                                            <div class="comment-block">
                                                                <div class="comment-arrow"></div>
                                                                <span class="comment-by">
                                                                    <strong>John Doe</strong>
                                                                    <span class="float-right">
                                                                        <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                                                                    </span>
                                                                </span>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae.</p>
                                                                <span class="date float-right">January 12, 2020 at 1:38 pm</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li> --}}
                                        </ul>

                                    </div>

                                    <div class="post-block mt-5 post-leave-comment">
                                        <h4 class="mb-3">Leave a comment</h4>

                                        @if ( Auth::check() )
                                            <form class="contact-form p-4 rounded bg-color-grey" action="{{ route('send.comment') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $post->id }}" name="post_id" class="form-control">
                                                <div class="p-2">
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-6">
                                                            <label class="required font-weight-bold text-dark">Full Name</label>
                                                            <input type="text" value="{{ Auth::user()->name }}" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" required>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label class="required font-weight-bold text-dark">Email Address</label>
                                                            <input type="email" value="{{ Auth::user()->email }}" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col">
                                                            <label class="required font-weight-bold text-dark">Comment</label>
                                                            <textarea maxlength="5000" data-msg-required="Please enter your message." rows="8" class="form-control" name="message" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col mb-0">
                                                            <input type="submit" value="Post Comment" class="btn btn-primary btn-modern" data-loading-text="Loading...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <div class="col-lg-12">
                                                <div class="alert alert-info">You Want to Commnet in This Post. Please, <a href="{{ route('userLogin') }}">Login or SingUp</a> here.</div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @endforeach

                        </article>

                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('body-script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
@endsection
