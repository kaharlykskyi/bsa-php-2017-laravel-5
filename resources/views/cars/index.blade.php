@extends('cars.base')

@section('title', 'Car list')

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