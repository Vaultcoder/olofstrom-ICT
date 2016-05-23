@extends('layouts.admin')


@section('content')  
<h1>Lägg till XML document</h1>


{{ Form::open(array('route' => 'postXml', 'files' => true)) }}
	{{ Form::token() }}
    {{ Form::file('file') }}
    <p>vänligen stäng inte ner sidan, då det kan avbryta processen. <br>Detta kan ta upp till 4-5 min.</p>
    {{ Form::submit('upload!') }}
    {{ Form::reset('Reset') }}
{{ Form::close() }}

@stop