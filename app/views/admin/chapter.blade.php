


<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <title>Home Page</title>
@stop

@section('content')    
<div class="row" style="border-bottom:solid;">
	<div class="small-12 columns">
    	<div class="headerdiv headerdivtext"><h2>{{ 'Du redigerar modulen:', " ",  $module->name }}</h2></div>
  	</div>
  	<div class="small-12 columns">
  		<div class="small-4 columns">
		<p id="information"><i class="fa fa-question-circle"></i>Håll över knapparna för att få mer information.</p>
		</div>
		<div class="small-6 columns">
		</div>
		<div class="small-2 columns" style="padding-bottom:1%; padding-top:1%;">
			<p data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip" title="Lägg till ett nytt kapitel."><a href=" {{ URL::route ('addChapter', array($module->id)) }}" class="button">Lägg till nytt kapitel</a></p>
		</div>
	</div>
		<div class="small-12 columns" id="one">
			<div class="small-2 columns" id="two">
				Titel
			</div>
			<div class="small-2 columns" id="two">
				Antal frågor
			</div>
			<div class="small-1 columns" id="two">
			</div>
			<div class="small-4 columns" id="two">
				Meny
			</div>
		</div>
		@foreach($chapters as $chapter)
		<div class="small-12 columns" id="five">
			<div class="small-2 columns" id="three">
				<p style="font-weight:bold; font-family:Georgia; margin-top:20%;">{{ $chapter->title }}</p>
			</div>
			<div class="small-2 columns" id="three" >
				@if($chapter->isQuestions == 1)
					<p style="font-weight:bold; font-family:Georgia; margin-top:20%;">{{ $questions }} st</p>
				@endif
			</div>
			<div class="small-4 columns" id="three">
			</div>
			<div class="small-1 columns" id="four">
				<p data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip" title="Klicka för att visa/gömma innehållet i modulen."><a href="javascript:toggleDiv('{{ $chapter->id }}');"class="button"><i class="fa fa-angle-double-down "></i></a></p>
			</div>
			<div class="small-1 columns" id="four">
				<p data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip" title="Redigera kapitlets innehåll."><a href="  {{ URL::route ('editChapter', array($module->id, $chapter->id)) }}"class="button"><i class="fa fa-pencil"></i></a></p>
			</div>
			<div class="small-1 columns" id="four">
					<p data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip" title="Radera kapitel."><a href="{{ URL::route ('removeChapter', array($module->id, $chapter->id)) }}"class="button" onclick="return confirm('Är du säker på att du vill ta bort kapitlet?')"><i class="fa fa-trash "></i></a></p>
			</div>
			<div class="small-1 columns" id="four">
				@if($chapter->isQuestions == 1)
				<p data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip" title="Lägg till eller ta bort frågor och svar."><a href="  {{ URL::route ('question', array($module->id, $chapter->id)) }}" class="button"><i class="fa fa-pencil-square-o "></i></a></p>
				@endif			
			</div>		
			<div class="small-12 columns" id="three">
				<div id="{{ $chapter->id }}" style="display:none;">
				{{ $chapter->body }} 
				</div>
			</div>
		</div>
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