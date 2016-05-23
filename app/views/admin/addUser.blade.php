<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    
    lägg till användare
@stop

<!-- Add some words into the content section -->
@section('content')


    <h1>Lägg till användare</h1>
        {{ Form::open(array('route' => 'postUser')) }}
            <div class="left-form-part">
            {{ Form::token() }}

            {{ Form::label('email', 'E-postadress') }}
            {{ Form::text('email', Input::old(''), array('placeholder' => 'david90@gmail.com')) }}

            {{ Form::label('fname', 'Förnamn') }}
            {{ Form::text('fname', null, array('placeholder' => 'David')) }}
    
            {{ Form::label('lname', 'Efternamn') }}
            {{ Form::text('lname', null, array('placeholder' => 'Jonnson')) }}

            {{ Form::label('admin', 'Ska han vara admin') }}
            {{ Form::checkbox('admin') }}
            <br>
            {{ Form::submit('Submit!', array('class' => 'button')) }}
            </div>
        {{ Form::close() }}
@stop


