@extends('cars.base')

@section('title', 'Car list')

@section('header')
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ URL::route('index') }}">Car hire service</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        @can('deleteCar', App\Entity\Car::class)
                            <li class="@yield('create-active')"><a href="{{ URL::route('cars.create') }}">Add</a></li>
                        @endcan
                        <li><a href="{{ URL::route('cars.index') }}">Cars list</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
@endsection

@section('content')
    @if(count($cars) === 0)
        <div class="alert alert-warning" role="alert">
            <h3 class="alert-heading">No cars</h3>
        </div>
    @else
        @if($message != null)
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="alert-heading">{{ $message }}</h5>
            </div>
        @endif
        <ul class="list-unstyled">
            @each('cars/list-item', $cars, 'car')
        </ul>
    @endif
@endsection