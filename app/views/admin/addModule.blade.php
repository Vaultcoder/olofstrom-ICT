<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    
    <title>skapa modul</title>
@stop

<!-- Add some words into the content section -->
@section('content')    

   

    {{ Form::open(array('route' => 'postModule', 'files' => true)) }}
    	{{ Form::label('name','Kurs namn') }}

        {{ Form::text('name', null, array('style' => 'color:black;', 'placeholder' => 'Namn på modulen')) }}
        <p>Välj dekal för din kurs,</p><br>
        {{ Form::file('decal') }}
        {{ Form::submit('Skapa Modul', array('class' => 'button')) }}

    {{ Form::close() }}

@stop