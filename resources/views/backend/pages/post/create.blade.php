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
                                <h4 class="card-title mb-0 flex-grow-1">Add New Post</h4>
                                <div class="flex-shrink-0">
                                    {{-- <button type="button" class="btn btn-soft-info btn-sm" fdprocessedid="7c7pql">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                    </button> --}}
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="{{ route('post.store') }}" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-6">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" id="title" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Please provide Name
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="category_id" class="form-label">Please Select The Category If Any</label>
                                        <select class="form-select mb-3" aria-label="Default select example" name="category_id" id="category_id" required>
                                            <option value="0">Please Select any Category</option>
                                            @foreach ($pcategories as $pCat)
                                                <option value="{{ $pCat->id }}">{{ $pCat->name }}</option>
                                                @foreach (App\Models\Category::orderBy('name', 'asc')->where('is_parent', $pCat->id)->get() as $cCat )
                                                    <option value="{{ $cCat->id }}">-- {{ $cCat->name }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid any Category.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Active Status</label>
                                        <select class="form-select mb-3" aria-label="Default select example" name="status" required>
                                            <option>Please Select the Status</option>
                                            <option value="1">Published</option>
                                            <option value="2">Draft</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid Status.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="formFile" class="form-label">Title Image</label>
                                        <input class="form-control" name="image" type="file" id="formFile">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="description" placeholder="Required example textarea" rows="5"
                                            required></textarea>
                                        <div class="invalid-feedback">
                                            Please enter a message in the textarea.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tags" class="form-label">Meta Tags [ Please Separate the Tags using Comma (,) ]</label>
                                        <input type="text" name="tags" class="form-control" id="tags" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Please provide Meta Tags
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Add New Post</button>
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
