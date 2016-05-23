<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    
    <title>Användarhantering</title>
@stop

<!-- Add some words into the content section -->
@section('content')    


        <h1>Redigera kapitel</h1>
        
        {{ Form::open(array('route' => array('postEditChapter', $chapter->m_id, $chapter->id))) }}
            <p> Nu redigerar du Kapitlet : {{ $chapter->title }}</p>
            <br>

            {{ Form::label('title', 'Nytt kapitelnamn') }}
            {{ Form::text('title', $chapter->title) }}

    @if($chapter->isQuestions == 0)
    	
     {{ Form::textarea('body', $chapter->body, array('id' => 'editor1')) }} 

    @endif

        	{{ Form::submit('Submit!', array('class' => 'button')) }}

        {{ Form::close() }}

@stop