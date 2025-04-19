<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.dashboard.component.head')
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            @include('backend.dashboard.component.sidebar')
        </nav>

        <div id="page-wrapper" class="gray-bg">
            @include('backend.dashboard.component.nav')
            @include($template)
            @include('backend.dashboard.component.footer')

        </div>

    </div>
    @include('backend.dashboard.component.scrip')

</body>

</html>
