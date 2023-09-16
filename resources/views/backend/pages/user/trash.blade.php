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
                                <h4 class="card-title mb-0 flex-grow-1">Trash All Users</h4>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('user.manage') }}" class="btn btn-soft-info btn-sm">View Manage</a>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                @if ( $users->count() > 0 )
                                    <div class="table-responsive table-card">
                                        <table class="table table-nowrap table-bordered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">#SL.</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Full Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">AddressLine 01</th>
                                                    <th scope="col">AddressLine 02</th>
                                                    <th scope="col">Country</th>
                                                    <th scope="col">ZipCode</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1; @endphp
                                                @foreach($users as $user)
                                                    <tr>
                                                        {{-- <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="cardtableCheck01">
                                                                <label class="form-check-label" for="cardtableCheck01"></label>
                                                            </div>
                                                        </td> --}}
                                                        <td><a href="#" class="fw-semibold">{{ $i }}</a></td>
                                                        <td>
                                                            @if ( !is_null($user->image) )
                                                                <img src="{{ asset('images/user/' . $user->image ) }}" alt="" width="35">
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>{{ $user->address_line1 }}</td>
                                                        <td>{{ $user->address_line2 }}</td>
                                                        <td>{{ $user->country_name }}</td>
                                                        <td>{{ $user->zipCode }}</td>
                                                        <td>
                                                            @if( $user->is_admin == 1 )
                                                                <span class="badge bg-primary">Super Admin</span>
                                                            @elseif( $user->is_admin == 2 )
                                                                <span class="badge bg-info">Subscriber</span>
                                                            @elseif( $user->is_admin == 3 )
                                                                <span class="badge bg-warning">Editor</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if( $user->status == 1 )
                                                                <span class="badge bg-success">Active</span>
                                                            @elseif( $user->status == 0 )
                                                                <span class="badge bg-danger">Inactive</span>
                                                            @endif
                                                            {{-- <span class="badge bg-success">Paid</span>
                                                            <span class="badge bg-danger">Refund</span> --}}
                                                        </td>
                                                        <td>
                                                            <div class="hstack gap-3 fs-15">
                                                                <a href="{{ route('user.edit', $user->id) }}" class="link-primary"><i class="ri-edit-2-line"></i></a>
                                                                <a href="" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $user->id }}" class="link-danger"><i class="ri-delete-bin-5-line"></i></a>
                                                            </div>
                                                        </td>

                                                        <!-- staticBackdrop Modal -->
                                                        <div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                            <h4 class="mb-3">Are you confirm to delelet this User?</h4>
                                                                            {{-- <p class="text-muted mb-4"> The transfer was not successfully received by us. the email of the recipient wasn't correct.</p> --}}
                                                                            <div class="hstack gap-2 justify-content-center">
                                                                                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                                                                {{-- <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button> --}}
                                                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
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
