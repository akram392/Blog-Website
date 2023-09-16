<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<!-- Mirrored from themesbrand.com/velzon/html/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Apr 2023 17:54:13 GMT -->
<head>

    @include('backend.includes.header')
    @yield('page-title')
    @include('backend.includes.css')
    @yield('body-css')

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('backend.includes.topbar')
        @include('backend.includes.sidebar')
        @yield('body-content')
        @include('backend.includes.footer')

    </div>
    <!-- END layout-wrapper -->

    @include('backend.includes.scripts')
	@yield('body-script')

</body>

<!-- Mirrored from themesbrand.com/velzon/html/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Apr 2023 17:55:14 GMT -->
</html>
