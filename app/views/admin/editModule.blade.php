<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    <!-- befintlig kod när jag öppnade dokumentet/LWA -->
    <!-- <title>redigera användaren</title> -->
    <title>redigera modul</title>
@stop

<!-- Add some words into the content section -->
@section('content')    


        <h1>Redigera modul</h1>
        
        {{ Form::open(array('route' => array('editModule', $module['id']), 'files' => true)) }}
            <p> Nu redigerar du Modulen : {{ $module->name }}</p>
            <br>

            {{ Form::label('name', 'Nytt modulnamn') }}
            {{ Form::text('name', $module->name) }}

            {{ Form::hidden('decalName', $module->decal) }}
            {{ Form::file('decal') }}
            {{ Form::submit('Submit!', array('class' => 'button')) }}

        {{ Form::close() }}
        </br>
        <p>Nuvarande dekal för modulen: </p>
         </br>
        <img src="/img/decals/{{ $module['decal'] }}" style="padding-bottom:2%;" width="50%" height="50%;">
@stop