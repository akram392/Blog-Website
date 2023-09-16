<!DOCTYPE html>
<html>
	<head>

		@include('frontend.includes.header')
        @yield('page-title')
        @include('frontend.includes.css')
        @yield('body-css')

	</head>
	<body>

		<div class="body">
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v17.0" nonce="t2yGyLQ0"></script>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v17.0" nonce="JZGsKgAD"></script>

			@include('frontend.includes.topbar')
            @yield('body-content')
            @include('frontend.includes.footer')

		</div>

        @include('frontend.includes.scripts')
        @yield('body-script')

	</body>
</html>
