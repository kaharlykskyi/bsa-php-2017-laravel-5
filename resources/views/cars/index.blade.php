@extends('cars.base')

@section('title', 'Car list')

@section('content')
    @if(count($cars) === 0)
        <div class="alert alert-warning" role="alert">
            <h3 class="alert-heading">No cars</h3>
        </div>
    @else
        <ul class="list-unstyled">
            @each('cars/list-item', $cars, 'car')
        </ul>
    @endif
@endsection