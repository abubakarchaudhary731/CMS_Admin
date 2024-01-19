@extends('cms::layouts.master')

@section('content')
    <div class="container">
        @include('layouts.navbars.auth.nav')
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        <a href="{{route('cms.view')}}" class="btn btn-primary mt-4"> Create New Post </a>
        <div class="row mt-2">
            @foreach ($usersWithPosts as $index => $userWithPost)
                <div class="col-sm-4 mb-3 mb-sm-0 my-4">
                  <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <small class="card-title"> {{$userWithPost->email}} </small>
                            @if (session()->get('user_details') && $userWithPost->id == session()->get('user_details')['user_id'])    
                            <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('cms.post.edit', ['id' => $userWithPost->post_id]) }}">Edit</a></li>
                                    <li><a class="dropdown-item" href="{{ route('cms.post.delete', ['id' => $userWithPost->post_id]) }}">Delete</a></li>
                                </ul>
                            @endif
                        </div>
                      <p class="card-text"> {!! $userWithPost->post_desc !!} </p>
                      <a href="{{route('cms.post.view', ['id' => $userWithPost->post_id])}}" class="btn btn-primary"> View </a>
                    </div>
                  </div>
                </div>
            @endforeach
    </div>
@endsection
