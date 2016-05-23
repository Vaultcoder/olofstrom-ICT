<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    
@stop

@section('content')    
{{ Form::open(array('route' => array('postAddAnswer', $m_id, $c_id, $q_id))) }}

	{{ Form::label('Lägg till svar') }}
	{{ Form::text('answer') }}

	{{ Form::label('Kryssa i här om detta svaret är det rätta!') }}
	{{ Form::checkbox('correct') }}

 	{{ Form::submit('Submit!', array('class' => 'tiny button')) }}
{{ Form::close() }}
    
@stop