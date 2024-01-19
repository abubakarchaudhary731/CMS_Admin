@extends('cms::layouts.master')
@section('content')
    <div class="container py-5">
        @include('layouts.navbars.auth.nav')
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <form action="{{($id > 0) ? route('cms.post.update', ['id' => $id]) : route('cms.post.create')}}" method="POST">
            @csrf
            <textarea name="description" id="" cols="30" rows="10">{{($id > 0) ? $post->description : '' }}</textarea>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-2">{{($id > 0) ? "Update" : "Post"}}</button>
            </div>
        </form>
    </div>
@endSection