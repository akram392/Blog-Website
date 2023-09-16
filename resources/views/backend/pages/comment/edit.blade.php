@extends('backend.layout.template')

@section('page-title')
    <title>Admin Dashboard | Bloging Portal</title>
@endsection

@section('body-content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-12">

                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Update Comment Status</h4>
                                {{-- <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-info btn-sm" fdprocessedid="7c7pql">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                    </button>
                                </div> --}}
                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="{{ route('comment.update', $comment->id) }}" method="POST" class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">User ID</label>
                                        <input type="text" name="user_id" class="form-control" id="user_id" value="{{ $comment->user_id }}" required readonly>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Post ID</label>
                                        <input type="text" name="post_id" class="form-control" id="post_id" value="{{ $comment->post_id }}" required readonly>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="message" class="form-label">Comment</label>
                                        <textarea class="form-control" name="message" id="message" placeholder="Required example textarea"
                                            required>{{ $comment->message }}</textarea>
                                        <div class="invalid-feedback">
                                            Please enter a message in the textarea.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Active Status</label>
                                        <select class="form-select mb-3" aria-label="Default select example" name="status" required>
                                            <option>Please Select the Status</option>
                                            <option value="1" @if ( $comment->status == 1) selected @endif >Approved</option>
                                            <option value="2" @if ( $comment->status == 2) selected @endif >Not Approved</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid Status.
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Save Changes</button>
                                    </div>
                                </form>
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
