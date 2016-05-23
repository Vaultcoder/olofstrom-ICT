<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    
@stop

@section('content')    
  


{{ Form::open(array('route' => array('postEditQuestion', $m_id, $c_id, $q_id->id))) }}

	{{ Form::label('Redigera din fråga:') }}
	{{ Form::text('question', $q_id->body) }}

 	{{ Form::submit('Submit!', array('class' => 'tiny button')) }}
{{ Form::close() }}

@stop