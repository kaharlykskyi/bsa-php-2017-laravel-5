@extends('errors.base')
@section('title', '404 Error')

@section('content')
    <div id="error" class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="alert-heading text-center"><strong>OOPS!</strong> 404 <span class="not-found">Page Not Found</span></h4>
        <div id="back-btn">
            <a class="btn btn-success" href="{{ route('index') }}">Back</a>
        </div>
    </div>
@endsection