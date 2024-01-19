@extends('cms::layouts.startup')

@section('content')
<div class="container py-5">
     <!-- Display Category Information -->
    <div class="jumbotron bg-light p-5 rounded-4 text-center">
        <p class="text-center"> {!! $post->description !!} </p>
        <pre class="text-center"> {{$user->email}} </pre>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <p class="lead">
            <pre> {{$post->created_at}} </pre>
        </p>
    </div>

        <!-- Ask Question Form -->

        <h2 class="my-3"> Write Comment: </h2>
        <div class="border border-1 p-3 rounded-3">
           @if (session()->has('user_details'))
            <form action="{{route('cms.comment.post', $post->id)}}" method="POST">
                @csrf
                <textarea name="comment" id="desc" class="form-control my-3" cols="30" rows="4" placeholder="Enter Your Comment"></textarea>
                <button class="btn btn-success" type="submit">Submit</button>
                <small>  </small>
            </form>
            @else
                <p> Please <a href="{{route('login')}}"> Login </a> to write a comment</p>
           @endif
        </div>
        
        <!-- COMMENT Section -->
        @foreach ( $comments as $index => $comment )
        <div class="media d-flex gap-3 my-2">
            <img class="align-self-start mr-3 rounded-circle" src="https://source.unsplash.com/500x400/?coding" width="60px" height="60px" alt="Generic placeholder image">
            <div class="media-body flex-grow-1">
                <div class="d-flex justify-content-between">
                    <b> {{$comment->userEmail}} </b>
                    <div>
                        <i><small> {{$comment->created_at}} </small></i>
                        <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu">
                                @if (session()->get('user_details') && $comment->userId == session()->get('user_details')['user_id'])
                                    {{-- <li><a class="dropdown-item" href="{{route('comment.edit', $comment->commentId)}}"> Edit </a></li> --}}
                                    <li><a class="dropdown-item" href="{{route('cms.comment.delete', $comment->commentId)}}"> Delete </a></li>
                                @endif
                                <li><a class="dropdown-item" type="button" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$comment->commentId}}"> Replay </a></li>
                            </ul>
                             <!-- Modal -->
                             <div class="modal fade" id="exampleModal{{$comment->commentId}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"> Replay to {{$comment->userEmail}} </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        {{-- <form action="{{route('replay.post', $comment->commentId)}}" method="POST">
                                        @csrf  --}}
                                        <div class="modal-body">
                                                <textarea name="replay" class="form-control my-3"  placeholder="Enter Your Replay"> </textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary"> Replay </button>
                                            </div>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <p> {!! $comment->comment !!} </p>
            </div>
        </div> 
       
        @endforeach
@endsection