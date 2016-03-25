@extends('templates.default')
@section('content')
    <h3>Sign In</h3>
    <div class="row">
        <div class="col-lg-6">
            {{Form::open(['route'=>'auth.signin', 'class'=>'form-vertical', 'role'=>'form'])}}
            <div class="form-group{{ $errors->has('username') ? ' has-error': '' }}">
                {{Form::label('username', 'Username', ['class' => 'control-label'])}}
                {{Form::text('username', '', ['class'=> 'form-control','value'=> old('username')])}}
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error': '' }}">
                {{Form::label('password', 'Password', array('class' => 'control-label'))}}
                {{Form::password('password', ['class'=> 'form-control'])}}
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="checkbox">
                <label>
                    <input name="remember" type="checkbox">Remember me
                </label>
            </div>
            <div class="form-group">
                {{Form::submit('Sign In', ['class'=>'btn btn-default'])}}
            </div>
            {{Form::close()}}
        </div>
    </div>
@stop