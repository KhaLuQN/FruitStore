<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.partials.head')
</head>

<body>



    <!-- Spinner Start -->
    @include('frontend.partials.spinner')
    <!-- Spinner End -->

    <!-- Navbar start -->
    @include('frontend.partials.navbar')
    <!-- Navbar End -->




    @yield('content')


    <!-- Footer Start -->
    @include('frontend.partials.footer')
    <!-- Footer End -->

    @include('frontend.partials.js')
</body>

</html>
