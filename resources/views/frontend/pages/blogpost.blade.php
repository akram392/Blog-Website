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
                                                    <span><i class="far fa-comments"></i> <a href="#">
                                                            @php $i=0; @endphp
                                                            @foreach ( App\Models\Comment::orderby('id', 'asc')->where('post_id', $post->id)->where('status', 1)->get() as $comment )
                                                                @php $i++; @endphp
                                                            @endforeach
                                                            {{$i;}}
                                                            Comments
                                                        </a>
                                                    </span>
                                                    <span class="d-block mt-2"><a href="{{ route('post-details', $post->id) }}" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></span>
                                                </div>

                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-lg-12">
                                    <div class="alert alert-info">Sorry! No Blog Post Found in this Category.</div>
                                </div>
                            @endif

                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="pagination justify-content-end">
                                    {{ $posts->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection

@section('body-script')

@endsection
