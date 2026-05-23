<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    @section('navbar')
        <b>Ini Navbar Utama</b><br />
    @show

    @section('banner')
    @show

    <div class="container mt-3">
        @yield('content')
    </div>

</body>
</html>