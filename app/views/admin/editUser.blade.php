<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    
    <title>redigera användaren</title>
@stop

<!-- Add some words into the content section -->
@section('content')    

    

	    <h1>Redigera användare</h1>	
		
		{{ Form::open(array('route' => array('postEditUser', $user->id))) }}


			<p> Du redigera just nu <b>{{ $user->fname,' ', $user->lname }}</b></p>
			<br>


			{{ Form::token() }}
			<div class="left-form-part">
			{{ Form::label('email', 'Email Address') }}
			{{ Form::text('email', $user->email) }}

			{{ Form::label('fname', 'För Namn') }}
			{{ Form::text('fname', $user->fname) }}
	
			{{ Form::label('lname', 'Efter Namn') }}
			{{ Form::text('lname', $user->lname) }}

			{{ Form::label('admin', 'Ska personen vara admin') }}
			@if($user->isAdmin == 1)
				{{''; $checked = 'true'}}
			@else
				{{''; $checked = ''}}
			@endif

			{{ Form::checkbox('isAdmin', 0, $checked) }}
			<br>
			{{ Form::submit('Submit!', array('class' => 'tiny button')) }}
		 	</div>
		{{ Form::close() }}

@stop

