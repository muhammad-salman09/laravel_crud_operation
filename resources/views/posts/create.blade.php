@extends('layouts.app')
@section('content')
<!--Form For Creating a Post-->
<h1>Create Post</h1>
<!--Form Properties-->
        {!! Form::open(['action'=>'PostController@store','method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    <!--For Input Title-->
        <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
    </div>
    <!--For Input Body-->
    <div class="form-group">
        {{Form::label('body','Body')}}
        {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body'])}}
    </div>
    <!--For Image Uploading-->
    <div class="form-group">
        {{Form::file('coverimage')}}
    </div>
    <!--Butto For Submit Your Data-->
        {{Form::submit('submit',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!} 
@endsection