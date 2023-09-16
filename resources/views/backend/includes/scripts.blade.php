{{-- <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}

<!-- JAVASCRIPT -->
<script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('backend/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('backend/js/plugins.js') }}"></script>

<!-- apexcharts -->
<script src="{{ asset('backend/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Vector map-->
<script src="{{ asset('backend/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ asset('backend/libs/jsvectormap/maps/world-merc.js') }}"></script>

<!--Swiper slider js-->
<script src="{{ asset('backend/libs/swiper/swiper-bundle.min.js') }}"></script>

<!-- Dashboard init -->
<script src="{{ asset('backend/js/pages/dashboard-ecommerce.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('backend/js/app.js') }}"></script>

<!-- Toastr JS  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Toastr calling JS Methods -->
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
<script>
    @if ( Session::has('message') )
        var type = "{{ Session::get('alert-type', 'info') }}" ;

        switch (type) {
            case 'info':
                toastr.info( "{{ Session::get('message') }}" );
            break;
            case 'success':
                toastr.success( "{{ Session::get('message') }}" );
            break;
            case 'warning':
                toastr.warning( "{{ Session::get('message') }}" );
            break;
            case 'error':
                toastr.error( "{{ Session::get('message') }}" );
            break;
        }
    @endif
</script>
