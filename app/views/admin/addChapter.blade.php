<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
     <title>lägg till kapitel</title>
    {{ HTML::script('js/isQ.js') }}
@stop

<!-- Add some words into the content section -->
@section('content')    


        <h1>Lägg till ett nytt kapitel</h1>
        <p> Nu lägger vi till ett kapitel till Modulen: {{ $module->name }}</p> <br>
        <!-- gets the name of the module that you are at -->
        <p>Är det ett Textavsnitt eller en Quizz du vill lägga till?</p><br>

        <button id="isT" onclick="showArea()"> Text! </button>
        <button id="isQ" onclick="hideArea()"> Quizz! </button>
        {{ Form::open(array('route' => array('postAddChapter', $module->id))) }} 
        <!-- passing the id of the module that you are at -->
            
            
            {{ Form::text('title', null, array('style' => 'margin-top: 1%;', 'placeholder' => 'Kapitlets namn')) }}

            <!-- The name of the new chapter -->
            
            <div id="chapterEditor">
                {{ Form::textarea('body', null, array('id' => 'editor1')) }} 
            </div>
            <!-- textarea with an id set to chapterText visable only if Text! is clicked 
            (hidden if Quizz! is clicked see isQ.js)-->
            {{ Form::hidden('isQuestions', 'secret', array('id' => 'isQuestion')) }} 
            <!-- Hidden input with an id of isQuestion - gets value 0 ->Text! or 1->Quizz! from isQ.js  -->

            {{ Form::submit('Skapa Kapitel', array('style' => 'margin-top: 1%;', 'class' => 'button')) }}

        {{ Form::close() }}
       
            
@stop
