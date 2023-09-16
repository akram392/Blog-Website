@extends('backend.layout.template')

@section('page-title')
    <title>Admin Dashboard | Blog Portal</title>
@endsection

@section('body-content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-12">

                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Trash All Comments</h4>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('comment.manage') }}" class="btn btn-soft-info btn-sm">View Manage</a>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                @if ( $comments->count() > 0 )
                                    <div class="table-responsive table-card">
                                        <table class="table table-nowrap table-bordered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    {{-- <th scope="col">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="cardtableCheck">
                                                            <label class="form-check-label" for="cardtableCheck"></label>
                                                        </div>
                                                    </th> --}}
                                                    <th scope="col">ID.</th>
                                                    <th scope="col">User ID/Name</th>
                                                    <th scope="col">Post ID</th>
                                                    <th scope="col">Parent / Child</th>
                                                    <th scope="col">Message</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1; @endphp
                                                @foreach($comments as $comment)
                                                    <tr>
                                                        {{-- <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="cardtableCheck01">
                                                                <label class="form-check-label" for="cardtableCheck01"></label>
                                                            </div>
                                                        </td> --}}
                                                        <td><a href="#" class="fw-semibold">{{ $i }}</a></td>
                                                        <td>{{ $comment->user->name}}</td>
                                                        <td>{{ $comment->post_id }}</td>
                                                        <td>
                                                            @if ($comment->is_parent == 0)
                                                                <span class="badge bg-info">Parent Comment</span>
                                                            @else
                                                                {{ $comment->is_parent }}  <!--  parent class -> child class -> child name -->
                                                            @endif
                                                        </td>
                                                        <td>{{ $comment->message }}</td>
                                                        <td>
                                                            @if( $comment->status == 1 )
                                                                <span class="badge bg-success">Approved</span>
                                                            @elseif( $comment->status == 2 )
                                                                <span class="badge bg-danger">Not Approved</span>
                                                            @endif
                                                            {{-- <span class="badge bg-success">Paid</span>
                                                            <span class="badge bg-danger">Refund</span> --}}
                                                        </td>
                                                        <td>
                                                            <div class="hstack gap-3 fs-15">
                                                                <a href="{{ route('comment.edit', $comment->id) }}" class="link-primary"><i class="ri-edit-2-line"></i></a>
                                                                <a href="" data-bs-toggle="modal" data-bs-target="#deleteComment{{ $comment->id }}" class="link-danger"><i class="ri-delete-bin-5-line"></i></a>
                                                            </div>
                                                        </td>

                                                        <!-- staticBackdrop Modal -->
                                                        <div class="modal fade" id="deleteComment{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    {{-- <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Are you confirm to delect this Category?</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div> --}}
                                                                    <div class="modal-body text-center p-5">
                                                                        <lord-icon
                                                                            src="https://cdn.lordicon.com/lupuorrc.json"
                                                                            trigger="loop"
                                                                            colors="primary:#121331,secondary:#08a88a"
                                                                            style="width:120px;height:120px">
                                                                        </lord-icon>

                                                                        <div class="mt-4">
                                                                            <h4 class="mb-3">Are you confirm to delect this Comment?</h4>
                                                                            {{-- <p class="text-muted mb-4"> The transfer was not successfully received by us. the email of the recipient wasn't correct.</p> --}}
                                                                            <div class="hstack gap-2 justify-content-center">
                                                                                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                                                                {{-- <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button> --}}
                                                                                <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                                                                    @csrf
                                                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                                                    {{-- <input type="button" value=""> --}}
                                                                                </form>
                                                                                {{-- <a href="javascript:void(0);" class="btn btn-success">Completed</a> --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                    @foreach ( App\Models\Comment::orderby('id', 'asc')->where('is_parent', $comment->id)->get() as $childComment )
                                                        @php $i++; @endphp
                                                        <tr>
                                                            {{-- <td>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="cardtableCheck01">
                                                                    <label class="form-check-label" for="cardtableCheck01"></label>
                                                                </div>
                                                            </td> --}}
                                                            <td><a href="#" class="fw-semibold">{{ $i }}</a></td>
                                                            <td>{{ $childComment->user->name }}</td>
                                                            <td>{{ $childComment->post_id }}</td>
                                                            <td>
                                                                @if ($childComment->is_parent == 0)
                                                                    <span class="badge bg-info">Parent Comment</span>
                                                                @else
                                                                    <span class="badge bg-warning">Child Comment</span>   <!--  parent class -> child class -> child name -->
                                                                @endif
                                                            </td>
                                                            <td>{{ $childComment->message }}</td>
                                                            <td>
                                                                @if( $childComment->status == 1 )
                                                                    <span class="badge bg-success">Approved</span>
                                                                @elseif( $childComment->status == 2 )
                                                                    <span class="badge bg-danger">Not Approved</span>
                                                                @endif
                                                                {{-- <span class="badge bg-success">Paid</span>
                                                                <span class="badge bg-danger">Refund</span> --}}
                                                            </td>
                                                            <td>
                                                                <div class="hstack gap-3 fs-15">
                                                                    <a href="{{ route('comment.edit', $childComment->id) }}" class="link-primary"><i class="ri-edit-2-line"></i></a>
                                                                    <a href="" data-bs-toggle="modal" data-bs-target="#deleteChildComment{{ $childComment->id }}" class="link-danger"><i class="ri-delete-bin-5-line"></i></a>
                                                                </div>
                                                            </td>

                                                            <!-- staticBackdrop Modal -->
                                                            <div class="modal fade" id="deleteChildComment{{ $childComment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        {{-- <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Are you confirm to delect this Category?</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div> --}}
                                                                        <div class="modal-body text-center p-5">
                                                                            <lord-icon
                                                                                src="https://cdn.lordicon.com/lupuorrc.json"
                                                                                trigger="loop"
                                                                                colors="primary:#121331,secondary:#08a88a"
                                                                                style="width:120px;height:120px">
                                                                            </lord-icon>

                                                                            <div class="mt-4">
                                                                                <h4 class="mb-3">Are you confirm to delect this Child Comment?</h4>
                                                                                {{-- <p class="text-muted mb-4"> The transfer was not successfully received by us. the email of the recipient wasn't correct.</p> --}}
                                                                                <div class="hstack gap-2 justify-content-center">
                                                                                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                                                                    {{-- <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button> --}}
                                                                                    <form action="{{ route('comment.destroy', $childComment->id) }}" method="POST">
                                                                                        @csrf
                                                                                        <button type="submit" class="btn btn-danger">Yes</button>
                                                                                        {{-- <input type="button" value=""> --}}
                                                                                    </form>
                                                                                    {{-- <a href="javascript:void(0);" class="btn btn-success">Completed</a> --}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </tr>
                                                    @endforeach
                                                    @php $i++; @endphp
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <!-- Info Alert -->
                                    <div class="alert alert-info" role="alert">
                                        <strong> Sorry ! </strong> No Data Found in <b>System Database</b>.
                                    </div>

                                @endif

                            </div>
                        </div>

                    </div> <!-- end col -->
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Velzon.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

@section('body-script')

@endsection
