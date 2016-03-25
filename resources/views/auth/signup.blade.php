@extends('templates.default')
@section('content')
    <h3>Sign Up</h3>
    <div class="row">
        <div class="col-lg-6">
            {{Form::open(['route'=>'auth.signup', 'class'=>'form-vertical', 'role'=>'form'])}}
            <div class="form-group{{ $errors->has('email') ? ' has-error': '' }}">
                {{Form::label('email', 'E-Mail Address', array('class' => 'control-label'))}}
                {{Form::text('email', '', ['class'=> 'form-control','value'=> old('email') ])}}
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('username') ? ' has-error': '' }}">
                {{Form::label('username', 'Choose an username', array('class' => 'control-label'))}}
                {{Form::text('username', '', ['class'=> 'form-control','value'=> old('username')])}}
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error': '' }}">
                {{Form::label('password', 'Choose a password', array('class' => 'control-label'))}}
                {{Form::password('password', ['class'=> 'form-control'])}}
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                {{Form::submit('Sign Up', ['class'=>'btn btn-default'])}}
            </div>
            {{Form::close()}}
        </div>
    </div>
@stop