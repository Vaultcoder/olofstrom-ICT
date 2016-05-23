<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    
@stop

@section('content')    

{{ Form::open(array('route' => array('postEditAnswer', $m_id, $c_id, $a_id->id))) }}

	{{ Form::label('Redigera svar:') }}
	{{ Form::text('answer', $a_id->body) }}
	{{ Form::label('correct', 'Kryssa i om det är rätt svar') }}
	@if($a_id->correct == 1)
		{{''; $checked = 'true'}}
	@else
		{{''; $checked = ''}}
	@endif
	{{ Form::checkbox('correct', 0, $checked) }}
 	{{ Form::submit('Submit!', array('class' => 'tiny button')) }}
{{ Form::close() }}


@stop