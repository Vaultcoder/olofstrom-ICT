<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    
    <title>lägg till fråga med svar</title>
@stop


@section('content')   

{{ Form::open(array('route' => array('addQuestion'))) }}
	
	{{ Form::label('Fråga') }}
	{{ Form::text('question') }}

	{{ Form::label('Svar') }}
	{{ Form::text('question') }}




 	{{ Form::submit('Submit!') }}
{{ Form::close() }}


@stop