<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    
    <title>Home Page</title>
@stop

<!-- Add some words into the content section -->
@section('content')    

 

<!-- content header -->
<div class="row">
  <div class="small-12 columns headerdiv headerdivtext">Modul Statistik</div>
  

@foreach($stats as $data)
<div class="large-3 columns">
  <ul data-pie-id="my-cool-chart{{ $data['id'] }}">
    <li data-value="{{ $data['percentage'] }}">{{ $data['name'] }}</li>
    <li data-value="{{ $data['rest'] }}"></li>
  </ul>
  <div id="my-cool-chart{{ $data['id'] }}"></div>
</div>
@endforeach

  {{ HTML::script('js/vendor/dependencies.js') }}
  {{ HTML::script('js/pizza.js') }}
  <script>
    $(window).load(function() {
      Pizza.init();
      $(document).foundation();
    });
  </script>

</div>



        <h1>Redigera applikationsbeskrivningen</h1>
        
       {{ Form::open(array('route' => array('index', $pages->title, $pages->body))) }}
            <p> Nu redigerar du texten om Applikationen</p>
            <br>

            {{ Form::label('title', 'Ny Titel') }}
            {{ Form::text('title', $pages->title) }}
            {{ Form::textarea('body', $pages->body) }} 

            {{ Form::submit('Submit!', array('class' => 'button')) }}

        {{ Form::close() }}

@stop