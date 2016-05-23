<!-- Get the master layout -->
@extends('layouts.master')
<!-- Change title for home page with section -->
@section('head')
    @parent
    
    <title>Home Page</title>
@stop

<!-- Add some words into the content section -->

@section('content')  

<div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">
    <a href="#" id="scrollup"<i class="fa fa-arrow-up"></i>Top</a>
  
  <nav class="tab-bar" style="height: 0rem;">
      <section class="right-small" id="navbar-right" >
        <a class="right-off-canvas-toggle menu-icon"><span></span></a>
      </section>
    </nav>
    <aside class="right-off-canvas-menu">
      <ul class="off-canvas-list">
        <li><img src="{{ Auth::user()->profile_img }}" id="profilbild"></li>
        <li id="star-side-box"><i class="fa fa-star fa-2x" id="star-side-bar">{{ $total }}</i></li>
        <li><label>Meny</label></li>
        <li data-magellan-arrival="home" class=""><a href="/">Hem</a></li>
        <li><a href="{{ URL::route('getLogout') }}">Logga ut</a></li>
                        <li><label>Kapitel</label></li>
                        @foreach($menu as $item)
                            <li data-magellan-arrival="home" class=""><a href="{{ URL::route('viewChapter', array($module, $item['nr'])) }}">{{ $item['title'] }}</a></li>
                        @endforeach
                    
        



        <!-- om admin är inloggad -->
        @if (Auth::user()->isAdmin)
          <li><label>Admin</label></li>
          <li><a href="{{ URL::route('adminIndex') }}">Admin</a></li>
        @endif
      </ul>
    </aside>




 	
        <div class="large-12">
            <class data-magellan-destination="content-1">
              <div class="wrap-inside-modules">
                <div class="inside-module">     
                  <div id="content-1">
                    <h2>{{ $chapter->title }}</h2>

                        @if(isset($question))                         
                                <h4>{{ $question['body'] }}</h4> <br/>
                                    @if(!isset($qNr))
                                        {{''; $qNr = 2 }}
                                    @endif


                                <div class="row" >
                                   <ul class="small-block-grid-4" id="bajs">
                                    {{ Form::open(array('route' => array('nextQuestion', $chapter->m_id, $chapter->chapternumber, $qNr))) }}
                                        @foreach($answers as $answer)
                                            @if($answer['q_id'] == $question['id'])
                                                @if($lastAns == $answer['id'])
                                                  @if($answer['correct'] == 1)
                                                    <li style="color: green;">
                                                  @else
                                                    <li style="color: red;">
                                                  @endif
                                                    <input type="radio" name="answer" value="{{ $answer['id'] }}" checked required> {{ $answer['body'] }}</li>
                                                @else
                                                    <li><input type="radio" name="answer" value="{{ $answer['id'] }}" {{ $disabled }} required> {{ $answer['body'] }}</li>
                                                @endif  
                                            @endif
                                        @endforeach
                                        </ul>
                                      </div>


                                        {{ Form::hidden('gear', $gear) }}
                                        <div class="button-next"> 
                                        {{ Form::submit($submit, array('class' => 'button radius')) }}
                                        </div>




                                    {{ Form::close() }}
                        @else
                            <p>{{ nl2br($chapter->body) }}</p>
                        @endif
                          <br>
                          
                      </div>
                </div>
            </div>
         </div>

          <a class="exit-off-canvas"></a>
  </div>
</div>







    <script>
      $("#scrollup").hide();
        $(window).scroll(function() {
          if ($(window).scrollTop() > 100) {
            $("#scrollup").fadeIn("slow");
            }
            else {
              $("#scrollup").fadeOut("fast");
            }
        });
    </script>

		<script>
			$(document).foundation();
		</script>



<script>
  var cbpFixedScrollLayout = (function() {

  // cache and initialize some values
  var config = {
    // the cbp-fbscroller´s sections
    $sections : $( '#cbp-fbscroller > section' ),
    // the navigation links
    $navlinks : $( '#cbp-fbscroller > nav:first > a' ),
    // index of current link / section
    currentLink : 0,
    // the body element
    $body : $( 'html, body' ),
    // the body animation speed
    animspeed : 650,
    // the body animation easing (jquery easing)
    animeasing : 'easeInOutExpo'
  };

  function init() {

    // click on a navigation link: the body is scrolled to the position of the respective section
    config.$navlinks.on( 'click', function() {
      scrollAnim( config.$sections.eq( $( this ).index() ).offset().top );
      return false;
    } );

    // 2 waypoints defined:
    // First one when we scroll down: the current navigation link gets updated. 
    // A `new section´ is reached when it occupies more than 70% of the viewport
    // Second one when we scroll up: the current navigation link gets updated. 
    // A `new section´ is reached when it occupies more than 70% of the viewport
    config.$sections.waypoint( function( direction ) {
      if( direction === 'down' ) { changeNav( $( this ) ); }
    }, { offset: '30%' } ).waypoint( function( direction ) {
      if( direction === 'up' ) { changeNav( $( this ) ); }
    }, { offset: '-30%' } );

    // on window resize: the body is scrolled to the position of the current section
    $( window ).on( 'debouncedresize', function() {
      scrollAnim( config.$sections.eq( config.currentLink ).offset().top );
    } );
    
  }

  // update the current navigation link
  function changeNav( $section ) {
    config.$navlinks.eq( config.currentLink ).removeClass( 'cbp-fbcurrent' );
    config.currentLink = $section.index( 'section' );
    config.$navlinks.eq( config.currentLink ).addClass( 'cbp-fbcurrent' );
  }

  // function to scroll / animate the body
  function scrollAnim( top ) {
    config.$body.stop().animate( { scrollTop : top }, config.animspeed, config.animeasing );
  }

  return { init : init };

})();

</script>


@stop




