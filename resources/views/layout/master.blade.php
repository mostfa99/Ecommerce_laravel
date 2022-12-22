<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','unkwon Page ')</title>
</head>

<body>
    <!-- Start Navigation Bar  -->
    @include('layout.navbar')
    @yield('contant')

    <!-- Start Side Bar  -->
    @include('layout.sidebar')

</body>

</html>
