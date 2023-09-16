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
                                <h4 class="card-title mb-0 flex-grow-1">Add New User</h4>
                                <div class="flex-shrink-0">
                                    {{-- <button type="button" class="btn btn-soft-info btn-sm" fdprocessedid="7c7pql">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                    </button> --}}
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="{{ route('user.store') }}" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">User Name</label>
                                        <input type="text" name="name" class="form-control" id="name" required autocomplete="off">
                                        <div class="invalid-feedback">
                                            Please provide Name
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" required >
                                        <div class="invalid-feedback">
                                            Please provide your email
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <label for="">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone No." required >
                                        <div class="invalid-feedback">
                                            Please provide your Phone
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="country_name" class="form-label">Country Name</label>
                                        <input type="text" name="country_name" class="form-control" id="country_name" placeholder="Country Name" required >
                                        <div class="invalid-feedback">
                                            Please provide your country_name
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="address_line1" class="form-label">Address Line 01</label>
                                        <input type="text" name="address_line1" class="form-control" id="address_line1" placeholder="Address Line 01" required >
                                        <div class="invalid-feedback">
                                            Please provide your address_line1
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="address_line2" class="form-label">Address Line 02</label>
                                        <input type="text" name="address_line2" class="form-control" id="address_line2" placeholder="Address Line 02" required >
                                        <div class="invalid-feedback">
                                            Please provide your address_line2
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="zipCode" class="form-label">Zip Code</label>
                                        <input type="text" name="zipCode" class="form-control" id="zipCode" placeholder="Zip Code" required >
                                        <div class="invalid-feedback">
                                            Please provide your zipCode
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="is_admin" class="form-label">Please Select The Role If Any</label>
                                        <select class="form-select mb-3" aria-label="Default select example" name="is_admin" id="is_admin">
                                            <option>Please Select the Role</option>
                                            <option value="1" >Super Admin</option>
                                            <option value="2" >Subscriber</option>
                                            <option value="3" >Editor</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid any Role.
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
                                    <div class="col-md-6">
                                        <label for="formFile" class="form-label">User Image</label>
                                        <input class="form-control" name="image" type="file" id="formFile">
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Add New User</button>
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
