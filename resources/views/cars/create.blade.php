@extends('cars.base')

@section('title', 'Create new car')
@section('create-active','active')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Add new car</div>
        <div class="panel-body">
            <form action="{{ URL::route('cars.store') }}" class="form-horizontal" role="form" method="POST">
                {{ csrf_field() }}

                {{-- Model input --}}
                <div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
                    <label for="model" class="col-md-3 control-label">Model</label>

                    <div class="col-md-6">
                        <input id="model" type="text" class="form-control" name="model" value="{{ old('model') }}" autofocus>

                        @if ($errors->has('model'))
                            <span class="help-block">{{ $errors->first('model') }}</span>
                        @endif
                    </div>
                </div>

                {{-- Color input --}}
                <div class="form-group {{ $errors->has('color') ? 'has-error' : '' }}">
                    <label for="color" class="col-md-3 control-label">Color</label>

                    <div class="col-md-6">
                        <input id="color" type="text" class="form-control" name="color" value="{{ old('color') }}">

                        @if ($errors->has('color'))
                            <span class="help-block">{{ $errors->first('color') }}</span>
                        @endif
                    </div>
                </div>

                {{-- Registration number input --}}
                <div class="form-group {{ $errors->has('registration_number') ? 'has-error' : '' }}">
                    <label for="registration_number" class="col-md-3 control-label">Registration number</label>

                    <div class="col-md-6">
                        <input id="registration_number" type="text" class="form-control" name="registration_number" value="{{ old('registration_number') }}">

                        @if ($errors->has('registration_number'))
                            <span class="help-block">{{ $errors->first('registration_number') }}</span>
                        @endif
                    </div>
                </div>

                {{-- Year input --}}
                <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">
                    <label for="year" class="col-md-3 control-label">Year</label>

                    <div class="col-md-6">
                        <input id="year" type="text" class="form-control" name="year" value="{{ old('year') }}">

                        @if ($errors->has('year'))
                            <span class="help-block">{{ $errors->first('year') }}</span>
                        @endif
                    </div>
                </div>

                {{-- Color input --}}
                <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                    <label for="price" class="col-md-3 control-label">Price</label>

                    <div class="col-md-6">
                        <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}">

                        @if ($errors->has('price'))
                            <span class="help-block">{{ $errors->first('price') }}</span>
                        @endif
                    </div>
                </div>

                {{-- User input --}}
                <div class="form-group {{ $errors->has('user') ? 'has-danger' : '' }}">
                    <label class="col-md-3 control-label" for="user">Select car owner</label>
                    <div class="col-sm-6">
                        <select name="user" id="user" class="form-control {{ $errors->has('user') ? 'form-control-danger' : '' }}">
                            @foreach($user as $usr)
                                <option value="{{ $usr['id'] }}">{{ $usr['first_name'] }} {{$usr['last_name'] }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('user'))
                            <div class="form-control-feedback">{{ $errors->first('user') }}</div>
                        @endif
                    </div>
                </div>

                {{-- Submit button --}}
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
