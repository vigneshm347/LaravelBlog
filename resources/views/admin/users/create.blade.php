@extends('layouts.admin')

@section('content')
    <h1>Creating user</h1>
    {!! Form::open(["method"=>"post", "action"=>"AdminUserController@store", 'files'=>"true"]) !!}
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
        {!! Form::select('isActive',array(1=>'Active', 0=>'Not Active'), 0, ["class"=>"form-control"]) !!}
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
    @endsection