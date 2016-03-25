@extends('templates.default')
@section('content')
    <h3>Update your profile</h3>
    <div class="row">
        <div class="col-lg-6">
            {{Form::open(['route'=>'profile.edit', 'class'=>'form-vertical', 'role'=>'form'])}}
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group{{ $errors->has('first_name') ? ' has-error': '' }}">
                        {{Form::label('first_name', 'First name', ['class' => 'control-label'])}}
                        <input type="text" name="first_name" class="form-control" id="first_name"
                               value="{{ Request::old('first_name')?:Auth::user()->first_name  }}">
                        {{--{{Form::text('first_name', '', ['class'=> 'form-control','value'=> old('first_name')])}}--}}
                        @if ($errors->has('first_name'))
                            <span class="help-block"><strong>{{ $errors->first('first_name') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group{{ $errors->has('last_name') ? ' has-error': '' }}">
                        {{Form::label('last_name', 'Last name', ['class' => 'control-label'])}}
                        <input type="text" name="last_name" class="form-control" id="last_name"
                               value="{{ Request::old('last_name')?:Auth::user()->last_name  }}">
                        {{--{{Form::text('last_name', '', ['class'=> 'form-control','value'=> old('last_name')])}}--}}
                        @if ($errors->has('last_name'))
                            <span class="help-block"><strong>{{ $errors->first('last_name') }}</strong></span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group{{ $errors->has('location') ? ' has-error': '' }}">
                {{Form::label('location', 'Location', ['class' => 'control-label'])}}
                {{Form::text('location', '', ['class'=> 'form-control','value'=> /* Auth::user()->first_name ?:*/ old('location')])}}
                @if ($errors->has('location'))
                    <span class="help-block"><strong>{{ $errors->first('location') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                {{Form::submit('Update', ['class'=>'btn btn-default'])}}
            </div>
            {{Form::close()}}
        </div>
    </div>
@stop