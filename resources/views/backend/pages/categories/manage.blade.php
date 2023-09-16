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
                                <h4 class="card-title mb-0 flex-grow-1">Manage All Categories</h4>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('category.trash') }}" class="btn btn-soft-info btn-sm">View Trash</a>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                @if ( $categories->count() > 0 )
                                    <div class="table-responsive table-card">
                                        <table class="table table-nowrap table-bordered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="cardtableCheck">
                                                            <label class="form-check-label" for="cardtableCheck"></label>
                                                        </div>
                                                    </th>
                                                    <th scope="col">#SL.</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Parent / Child</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1; @endphp
                                                @foreach($categories as $category)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="cardtableCheck01">
                                                                <label class="form-check-label" for="cardtableCheck01"></label>
                                                            </div>
                                                        </td>
                                                        <td><a href="#" class="fw-semibold">{{ $i }}</a></td>
                                                        <td>{{ $category->name }}</td>
                                                        <td>
                                                            @if ($category->is_parent == 0)
                                                                <span class="badge bg-info">Parent Category</span>
                                                            @else
                                                                {{ $category->parent->name }}   <!--  parent class -> child class -> child name -->
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if( $category->status == 1 )
                                                                <span class="badge bg-success">Active</span>
                                                            @elseif( $category->status == 0 )
                                                                <span class="badge bg-danger">Inactive</span>
                                                            @endif
                                                            {{-- <span class="badge bg-success">Paid</span>
                                                            <span class="badge bg-danger">Refund</span> --}}
                                                        </td>
                                                        <td>
                                                            <div class="hstack gap-3 fs-15">
                                                                <a href="{{ route('category.edit', $category->id) }}" class="link-primary"><i class="ri-edit-2-line"></i></a>
                                                                <a href="" data-bs-toggle="modal" data-bs-target="#deleteCategory{{ $category->id }}" class="link-danger"><i class="ri-delete-bin-5-line"></i></a>
                                                            </div>
                                                        </td>

                                                        <!-- staticBackdrop Modal -->
                                                        <div class="modal fade" id="deleteCategory{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                            <h4 class="mb-3">Are you confirm to delect this Parent Category?</h4>
                                                                            {{-- <p class="text-muted mb-4"> The transfer was not successfully received by us. the email of the recipient wasn't correct.</p> --}}
                                                                            <div class="hstack gap-2 justify-content-center">
                                                                                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                                                                {{-- <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button> --}}
                                                                                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
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
                                                    @foreach ( App\Models\Category::orderBy('name', 'asc')->where('is_parent', $category->id)->get() as $childCategory)
                                                        @php $i++; @endphp
                                                        <tr>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="cardtableCheck01">
                                                                    <label class="form-check-label" for="cardtableCheck01"></label>
                                                                </div>
                                                            </td>
                                                            <td><a href="#" class="fw-semibold">{{ $i }}</a></td>
                                                            <td>{{ $childCategory->name }}</td>
                                                            <td>
                                                                @if ($childCategory->is_parent == 0)
                                                                    <span class="badge bg-info">Parent Category</span>
                                                                @else
                                                                    {{ $childCategory->parent->name }}   <!--  parent class -> child class -> child name -->
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if( $childCategory->status == 1 )
                                                                    <span class="badge bg-success">Active</span>
                                                                @elseif( $childCategory->status == 0 )
                                                                    <span class="badge bg-danger">Inactive</span>
                                                                @endif
                                                                {{-- <span class="badge bg-success">Paid</span>
                                                                <span class="badge bg-danger">Refund</span> --}}
                                                            </td>
                                                            <td>
                                                                <div class="hstack gap-3 fs-15">
                                                                    <a href="{{ route('category.edit', $childCategory->id) }}" class="link-primary"><i class="ri-edit-2-line"></i></a>
                                                                    <a href="" data-bs-toggle="modal" data-bs-target="#deleteCategory{{ $childCategory->id }}" class="link-danger"><i class="ri-delete-bin-5-line"></i></a>
                                                                </div>
                                                            </td>

                                                            <!-- staticBackdrop Modal -->
                                                            <div class="modal fade" id="deleteCategory{{ $childCategory->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                                <h4 class="mb-3">Are you confirm to delect this Child Category?</h4>
                                                                                {{-- <p class="text-muted mb-4"> The transfer was not successfully received by us. the email of the recipient wasn't correct.</p> --}}
                                                                                <div class="hstack gap-2 justify-content-center">
                                                                                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                                                                    {{-- <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button> --}}
                                                                                    <form action="{{ route('category.destroy', $childCategory->id) }}" method="POST">
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
