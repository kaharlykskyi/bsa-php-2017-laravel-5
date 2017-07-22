@extends('cars.base')

@section('title', $car['model'])
@section('list-active','active')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">{{ $car['model'] }}</div>
        <div class="panel-body">
            <p><span class="text-muted">Color:</span>&nbsp;{{ $car['color'] }}</p>
            <p><span class="text-muted">Price:</span>&nbsp;{{ $car['price'] }}</p>
            <p><span class="text-muted">Year:</span>&nbsp;{{ $car['year'] }}</p>
            <p><span class="text-muted">Registration number:</span>&nbsp;{{ $car['registration_number'] }}</p>
        </div>
        <div class="panel-footer">
            <a href="{{ URL::route('cars.edit', $car['id']) }}" class="btn btn-warning edit-button">Edit</a>
            <a href="{{ URL::route('cars.destroy', $car['id']) }}" class="btn btn-danger delete-button">Delete</a>
        </div>
    </div>
@endsection
