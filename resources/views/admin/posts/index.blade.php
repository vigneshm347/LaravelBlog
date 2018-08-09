@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>
    @if($posts)
    <table class="table">
        <thead>
          <tr>
            <th>Post ID</th>
              <th>Owner</th>
              <th>Photo</th>
              <th>Category</th>
            <th>Post title</th>
            <th>Content</th>
              <th>Created</th>
              <th>Updated</th>
          </tr>
        </thead>
        @foreach($posts as $post)
        <tbody>
          <tr>
            <td>{{$post->id}}</td>
              <td>{{$post->user->name}}</td>
              <td><img height="100" src="{{($post->photo)?$post->photo->path:'https://placehold.it/400X400'}}" alt=""></td>
              <td>{{($post->category_id)?$post->category->name:"Uncategorized"}}</td>
              <td>{{$post->title}}</td>
              <td>{{$post->body}}</td>
              <td>{{$post->created_at->diffForHumans()}}</td>
              <td>{{$post->updated_at->diffForHumans()}}</td>


          </tr>
            @endforeach
      </table>
    @endif
@endsection