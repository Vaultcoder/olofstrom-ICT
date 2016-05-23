<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <title>Home Page</title>
@stop



@section('content')    

<div class="row">
  <div class="small-12 columns">
    <div class="headerdiv headerdivtext">Modul</div><br />
  </div>



    <div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">
</div>


<div class="row">
  <div class="medium-10 columns"><section class="main-section">
        <div class="row">
            <div class="wrap-admin-modules">
            <p id="information"><i class="fa fa-question-circle"></i>Håll över knapparna för att få mer information.</p>
          <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4">
            <?php $number = 1; ?>
            @foreach($modules as $module)
            <div class="module-box">
              <section data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip" title="Översikt på modulens kapitel.
Redigera, Radera och skapa nya kapitel.">
              <li><a href="{{ URL::route('getChapters', $module->id) }}"><div class="admin-module" id="module{{ $number }}"><p>{{ $module->name }}<br><i class="fa fa-eye fa-2x"></i> </p></div></a>
              </section>
                <ul class="button-group">
                  <li><p data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip" title="Redigera modulens namn, och dekal"><a href="{{ URL::route('editModule', $module->id) }}" class="button" id="button"><i class="fa fa-pencil fa-2x"></i></a></p></li>
                  <li><p data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip" title="Ta bort modulen"><a href="{{ URL::route('removeModule', $module->id) }}" onclick="return confirm('Är du säker på att du vill ta bort modulen?');" class="button" id="button"><i class="fa fa-trash fa-2x"></i></a></p></li>             
                </ul>
              </li>
            </div>
                <?php $number = $number + 1; ?>
            @endforeach
                        <div class="module-box">
              <section data-tooltip aria-haspopup="true" data-options="disable_for_touch:true" class="has-tip" title="Skapa ny modul">
              <li><a href="{{ URL::route('addModule') }}"><div class="admin-module" id="skapa-modul"><p><br><i class="fa fa-plus-square-o fa-3x"></i></p></div></a>
              </section>
              </li>
            </div>
            <div ></div>
          </ul>
        </div>
      </section>

    </div>
    
</div>


    <script>
      $(document).foundation('alert', 'reflow');
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