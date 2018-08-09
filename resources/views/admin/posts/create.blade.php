@extends('layouts.admin')

@section('content')
    <h1>Create Post</h1>
    <div>
        {!! Form::open(['method'=>'post', 'action'=>'AdminPostController@store', 'files'=>'true', 'class'=>'col-lg-6']) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body', 'Body') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control', 'style'=>'resize:none;']) !!}
        </div>

        <div>
            {!! Form::label('photo_id', 'Photo') !!}
            {!! Form::file('photo_id') !!}
        </div>
        <br>
        <div class="form-group">
            {!! Form::label('category_id', 'Category') !!}
            {!! Form::select('category_id', [""=>"Choose Cateory"] + $categories, 0, ["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
        </div>
        <div>
            @include('errors.formError')
        </div>
        {!! Form::close() !!}
    </div>



@endsection