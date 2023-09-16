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
                                <h4 class="card-title mb-0 flex-grow-1">Add Categories</h4>
                                <div class="flex-shrink-0">
                                    {{-- <button type="button" class="btn btn-soft-info btn-sm" fdprocessedid="7c7pql">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                    </button> --}}
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="{{ route('category.store') }}" method="POST" class="row g-3 needs-validation" >
                                    @csrf
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Category name</label>
                                        <input type="text" name="name" class="form-control" id="name" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Please write a Catecory Name.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Please Select The Parent Category If Any</label>
                                        <select class="form-select mb-3" aria-label="Default select example" name="is_parent" required>
                                            <option value="0">Please Select The Parent Category</option>
                                            @foreach ( $parentCategories as $pCat )
                                                <option value="{{ $pCat->id }}">{{ $pCat->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid Parent Category.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="description" placeholder="Required example textarea"
                                            required></textarea>
                                        <div class="invalid-feedback">
                                            Please enter a message in the textarea.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Active Status</label>
                                        <select class="form-select mb-3" aria-label="Default select example" name="status" required>
                                            <option>Please Select the Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid Status.
                                        </div>
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                            <label class="form-check-label" for="invalidCheck">
                                                Agree to terms and conditions
                                            </label>
                                            <div class="invalid-feedback">
                                                You must agree before submitting.
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Add New Category</button>
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
