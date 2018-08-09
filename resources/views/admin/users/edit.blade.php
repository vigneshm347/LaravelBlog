@extends('layouts.admin')

@section('content')
    <h1>Edit user</h1>
    <div class="col-sm-9">
        {!! Form::model($user, ["method"=>"patch", "action"=>["AdminUserController@update", $user->id], 'files'=>"true"]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('role_id', 'Role') !!}
            {!! Form::select('role_id', [''=>"choose"] + $roles,null, ["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('isActive', 'Status') !!}
            {!! Form::select('isActive',array(1=>'Active', 0=>'Not Active'), null, ["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Choose File') !!}
            {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('submit', ["class"=>"btn btn-primary"]) !!}
        </div>
        {!! Form::close() !!}

        @include('errors.formError')
    </div>

    <div class="col-sm-3">
        <img src="{{($user->photo)?$user->photo->path:'https://placehold.it/400x400'}}" alt="" class="img-responsive img-circle">
    </div>

@endsection