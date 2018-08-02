@extends('layouts.app')

@section('content')
<h1>POSTS</h3>
          <!--For chek the posts-->
        @if(count($posts) > 0)
                @foreach($posts as $post)
                <div class="well">
                        <div class="row">
                                <div class="col-md-4 col-sm-4">
                                        <img style="width:100%" src="/storage/coverimage,/{{$post->coverimage}}">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                        {{$post->id}}
                                        <h3><a href="/post/{{$post->id}}">{{$post->title}}</a></h3>
                                        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                                </div>
                        </div>
                </div>
                @endforeach
        @else
                <p>not found</p>
        @endif
@endsection