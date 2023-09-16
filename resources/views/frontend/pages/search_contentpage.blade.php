{{-- @if($posts->isNotEmpty())
    @foreach ($posts as $post)
        <div class="post-list">
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
                    {{ $post->created_at }}
                </div>
            </div>
        </div>
    @endforeach
@else
    <div>
        <h2>No posts found</h2>
    </div>
@endif --}}
@extends('frontend.layout.template')

@section('page-title')
    <title>Blog 3 Columns | Blog Site</title>
@endsection

@section('body-css')

@endsection

@section('body-content')
    <div role="main" class="main">

        <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 align-self-center p-static order-2 text-center">

                        <h1 class="text-dark font-weight-bold text-8">Blog 3 Columns</h1>
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
                <div class="col">
                    <div class="blog-posts">

                        <div class="row">
                            @if ( $posts->count() > 0 )
                                @foreach ( $posts as $post )
                                    <div class="col-md-4">
                                        <article class="post post-medium border-0 pb-0 mb-5">
                                            <div class="post-image">
                                                <a href="{{ route('post-details', $post->id) }}">
                                                    <img src="{{ asset('images/post/' . $post->image ) }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                                                </a>
                                            </div>

                                            <div class="post-content">

                                                <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a href="{{ route('post-details', $post->id) }}">{{ $post->title }}</a></h2>
                                                <p>{{ substr($post->description, 0, 198) }}</p>

                                                <div class="post-meta">
                                                    <span><i class="far fa-user"></i> By <a href="{{ route('blogpage', $post->posted_by) }}">{{ $post->user->name }}</a> </span>
                                                    <span><i class="far fa-folder"></i><a href="{{ route('blogpage', $post->category_id) }}">{{ $post->category->name }}</a> </span>
                                                    <span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>
                                                    <span class="d-block mt-2"><a href="{{ route('post-details', $post->id) }}" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></span>
                                                </div>

                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-lg-12">
                                    <div class="alert alert-info">Sorry! No Blog Post Found in this Page.</div>
                                </div>
                            @endif

                        </div>

                        {{-- <div class="row">
                            <div class="col">
                                <ul class="pagination float-right">
                                    <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                                </ul>
                            </div>
                        </div> --}}

                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection

@section('body-script')

@endsection
