<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, width=device-width">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <style>
        .container {
            padding-top: 20px;
        }

        .help-block {
            color: darkred;
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ URL::route('index') }}">Car store</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="@yield('create-active')"><a href="{{ URL::route('cars.create') }}">Add</a></li>
                        <li><a href="{{ URL::route('cars.index') }}">Cars list</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    {{-- Main content --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @section('content')

                @show
            </div>
        </div>
    </div>
</body>
</html>