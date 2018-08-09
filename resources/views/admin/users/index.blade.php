@extends('layouts.admin')

@section('content')
    <h1>Users</h1>
        @if($users)
            <table class="table">
                <thead>
                  <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Registered on</th>
                  </tr>
                </thead>
            <tbody>

            @foreach($users as $user)
              <tr>
                <td><img height="100" src="{{($user->photo)?$user->photo->path:'https://placehold.it/400x400'}}" alt=""></td>
                <td><a href="{{route( 'users.edit', $user->id)}}">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                  <td>{{$user->role->name}}</td>
                <td>{{$user->isActive ? "Active" : "In-active"}}</td>
                  <td>{{$user->created_at->format('M d, Y') }}</td>
              </tr>
            @endforeach
        @endif



        </tbody>
      </table>
    @endsection