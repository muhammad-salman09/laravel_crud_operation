@extends('layouts.app')

@section('content')
        <h1> {{$post->title}} </h1>
        <div class="well">
                <img style="width:100%" src="/storage/coverimage,/{{$post->coverimage}}"><br><br>
            {!!$post->body!!}
        </div>
        <hr>
        <small>Written on: {{$post->created_at}} by {{$post->user->name}}</small>
            <hr>
            <a href="/post" class="btn btn-primary" role="button"> <span class="glyphicon glyphicon-arrow-left"></span> Go Back</a>
            @if(!Auth::guest())
            @if(Auth::user()->id == $post->user_id)
            <a href="/post/{{$post->id}}/edit" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-edit"></span> edit</a>
            {!! Form::open(['action'=>['PostController@destroy',$post->id],'method'=>'POST','class' => 'pull-right']) !!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
            {!!Form::close()!!}
            @endif
           @endif
            @endsection