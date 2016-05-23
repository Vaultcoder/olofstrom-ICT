<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <title>Home Page</title>
@stop

@section('content')    
  

  <div class="row">
	<div class="small-12 columns">
    	<div class="headerdiv headerdivtext"><h2>Frågor & svar</h2></div>
  	</div>
  	<div class="small-12 columns">
  		<div class="small-4 columns">
		<p id="information"><i class="fa fa-question-circle"></i> Håll över knapparna för att få mer information.</p>
		</div>
		<div class="small-8 columns" style="padding-bottom:1%; padding-top:1%;">
			{{ Form::open(array('route' => array('addQuestion', $m_id->id, $c_id->id))) }}
				{{ Form::label('Lägg till fråga') }}
				{{ Form::text('question') }}
			 	{{ Form::submit('Lägg till', array('class' => 'button')) }}
			{{ Form::close() }}
		</div>
	</div>
		<div class="small-12 columns" id="one">
			<div class="small-2 columns" id="two">
				Fråga
			</div>
			<div class="small-2 columns" id="two">
				Innehåll
			</div>
			<div class="small-2 columns" id="two">
			</div>
			<div class="small-3 columns" id="two">
				Meny
			</div>
		</div>
		{{''; $count = 1;}}
		@foreach($Q as $question)
		<div class="small-12 columns" id="five">
			<div class="small-2 columns" id="three">
				<p style="font-size:120%; font-weight:bold;">Nr: {{ $count }}</p>
			</div>
			<div class="small-2 columns" id="three" >
				<p style="font-size:120%; font-weight:bold;">{{ $question->body }}</p>
			</div>
			<div class="small-4 columns" id="three" >
			</div>
			<div class="small-1 columns" id="four">
				<p data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip" title="Klicka för att visa/gömma svaren.">
					<a class="small button" href="javascript:toggleDiv('{{ $question->id }}');"class="button">
					<i class="fa fa-angle-double-down fa-2x"></i>
					</a>
				</p>
			</div>
			<div class="small-1 columns" id="four">
				<p data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip" title="Klicka för att redigera frågan.">
					<a class="small button" href="{{ URL::route('editQuestion', array($m_id->id, $c_id->id, $question->id)) }}">
					<i class="fa fa-pencil fa-2x"></i>
					</a>
				</p>
			</div>
			<div class="small-1 columns" id="four">
				<p data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip" title="Klicka för att lägga till svar till frågan.">
					<a class="small button" href="{{ URL::route('addAnswer', array($m_id->id, $c_id->id, $question->id)) }}">
					<i class="fa fa-plus-square fa-2x"></i>
					</a>
				</p>
			</div>	
			<div class="small-1 columns" id="four">
				<p data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip" title="Klicka för att ta bort hela frågan.">
					<a class="small button" onclick="return confirm('Är du säker på att du vill ta bort Frågan?')" href="{{ URL::route('removeQuestion', array($m_id->id, $c_id->id, $question->id)) }}">
					<i class="fa fa-trash fa-2x"></i>
					</a>
				</p>
			</div>		
			<div class="small-12 columns" id="three">

				<div id="{{ $question->id }}" style="display:none;">
					@foreach($A as $answer)
						@if($answer->q_id == $question->id)
							<ul>
								<li id="linje">{{ $answer->body }}
									<a class="tiny button" style="float:right; margin-left:1%;" href="{{ URL::route('editAnswer', array($m_id->id, $c_id->id, $question->id, $answer->id)) }}">Ändra svar</a>
									<a class="tiny button" onclick="return confirm('Är du säker på att du vill ta bort svaret?')" style="float:right;" href="{{ URL::route('removeAnswer', array($m_id->id, $c_id->id, $answer->id)) }}">Ta bort svar</a>
									@if($answer->correct == 1)
										<i style="color:green; float:right; margin-left: 1%; margin-right: 1%;" <i class="fa fa-check fa-2x"></i>
									@else
										<i style="color:red; float:right; margin-left: 1%; margin-right: 1%;" class="fa fa-times fa-2x"></i>
									@endif
								</li>
							</ul>
						@endif	
					@endforeach
				</div>		
			</div>
		</div>
		{{''; $count += 1;}}
		@endforeach

</div>

<script type="text/javascript">
function toggleDiv(divId) {
   $("#"+divId).toggle(800);
}
</script>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( document ).tooltip({
      position: {
        my: "center bottom-20",
        at: "center top",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
            .addClass( "arrow" )
            .addClass( feedback.vertical )
            .appendTo( this );
        }
      }
    });
  });
  </script>


  <style>
  .ui-tooltip, .arrow:after {
    background: black;
    border: 2px solid white;
  }
  .ui-tooltip {
    padding: 10px 20px;
    color: white;
    border-radius: 20px;
    font: bold 14px "Helvetica Neue", Sans-Serif;
    text-transform: uppercase;
    box-shadow: 0 0 7px black;
  }
  .arrow {
    width: 70px;
    height: 16px;
    overflow: hidden;
    position: absolute;
    left: 50%;
    margin-left: -35px;
    bottom: -16px;
  }
  .arrow.top {
    top: -16px;
    bottom: auto;
  }
  .arrow.left {
    left: 20%;
  }
  .arrow:after {
    content: "";
    position: absolute;
    left: 20px;
    top: -20px;
    width: 25px;
    height: 25px;
    box-shadow: 6px 5px 9px -9px black;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }
  .arrow.top:after {
    bottom: -20px;
    top: auto;
  }
  </style>

    
@stop