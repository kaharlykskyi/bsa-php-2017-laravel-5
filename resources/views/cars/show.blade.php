@extends('cars.base')

@section('title', $car['model'])
@section('list-active','active')

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
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">{{ $car['model'] }}</div>
        <div class="panel-body">
            <p><span class="text-muted">Color:</span>&nbsp;{{ $car['color'] }}</p>
            <p><span class="text-muted">Price:</span>&nbsp;{{ $car['price'] }}</p>
            <p><span class="text-muted">Year:</span>&nbsp;{{ $car['year'] }}</p>
            <p><span class="text-muted">Registration number:</span>&nbsp;{{ $car['registration_number'] }}</p>
            <p><span class="text-muted">Mileage:</span>&nbsp;{{ $car['mileage'] }}</p>
            <p><span class="text-muted">Owner:</span>&nbsp;{{ $owner }}</p>
        </div>
        @can('editCar', $carObj)
            <div class="panel-footer">
                <a href="{{ URL::route('cars.edit', $car['id']) }}" class="btn btn-warning edit-button">Edit</a>
                <form id="delete" action="{{ route('cars.destroy', $car['id']) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete">
                    <button role="button" class="btn btn-danger">Delete</button>
                </form>
            </div>
        @endcan
    </div>
@endsection
