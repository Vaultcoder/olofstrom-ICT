<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    
    <title>Home Page</title>
@stop

@section('content')    





<p>FrågorQ</p>
<table>
	<tr>
	    <th>Id</th>
	    <th>m_id</th>
	    <th>c_id</th>
	    <th>body</th>
	   	<th>radera</th>
	    <th>edit</th>

	</tr>
@foreach($Q as $Q)
	<tr>
		<td>{{ $Q->id }}</td>
		<td>{{ $Q->m_id }}</td> 
		<td>{{ $Q->c_id }}</td>  
		<td>{{ $Q->body }}</td>
		<td><button>Radera</button></td>
		<td><button>Ändra</button></td>
	</tr>
@endforeach
</table>
<p>lägg till fråga</p>
{{ Form::open(array('route' => array('addQuestion'))) }}

	{{ Form::text('question') }}

 	{{ Form::submit('Submit!') }}
{{ Form::close() }}
<p>SvarA</p>
<table>
	<tr>
	    <th>id</th>
	    <th>qid</th>
	    <th>correct</th>
	    <th>m_id</th>
	    <th>c_id</th>
	    <th>body</th>
	    <th>radera</th>
	    <th>Edit</th>
	</tr>
@foreach($A as $A)
	<tr>
		<td>{{ $A->id }}</td>
		<td>{{ $A->q_id }}</td>
		<td>{{ $A->correct }}</td>		
		<td>{{ $A->m_id }}</td> 
		<td>{{ $A->c_id }}</td>  
		<td>{{ $A->body }}</td>
		<td><button>X</button></td>
		<td><button>Ändra</button></td>				
	</tr>	
@endforeach
</table>


    
@stop