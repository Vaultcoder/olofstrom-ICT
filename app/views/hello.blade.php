<!-- Get the master layout -->
@extends('layouts.master')

<!-- Change title for home page with section -->
@section('head')
    @parent
    
    <title>Home Page</title>
@stop

<!-- Add some words into the content section -->


@section('content')
<div id="myModal" class="reveal-modal" data-reveal>
  @if(isset($win) AND $win == 'true')
    <h1>Grattis du har klarat av: <span id="span2"></br>{{ $name }}</span></h1>
    <img src="/img/decals/{{ $img }}">
  @elseif(isset($win) AND $win == 'false')
    <h2>Du klarade inte av {{ $name }}</h2>
    <ul>
      <p>Du har svarat fel på:</p>
      @foreach($data as $questions)
        Fråga: {{ $questions['Question'] }}
      @endforeach
    </ul>
  @endif
  <a class="close-reveal-modal">&#215;</a>
</div>
    
  <div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">

  
     <!-- <div id="row-over-modules"> -->
    <ul class="example-orbit-content" data-orbit>
    <li data-orbit-slide="headline-1">
      <div>
        <h2 style="text-align: center; margin-top: 4%; color: white;">"Det näst bästa efter att veta något är att veta hur man ska ta reda på det" <br><span id="span1">- Samuel Johnson  (1709-1784)</span></h2>
      </div>
    </li>
    <li data-orbit-slide="headline-2">
      <div>
        <h2 style="text-align: center; margin-top: 4%; color: white;">"Alla människor har av naturen ett begär att få veta" <br><span id="span1">- Aristoteles (384 f.Kr.-322 f.Kr.)</span></h2>
      </div>
    </li>
    <li data-orbit-slide="headline-3">
      <div>
        <h2 style="text-align: center; margin-top: 4%; color: white;">"Att inse att man är okunnig är ett bra steg mot kunskap" <br><span id="span1">- Benjamin Disraeli (1804-1881)</span></h2>
      </div>
    </li>
    <li data-orbit-slide="headline-4">
      <div>
        <h2 style="text-align: center; margin-top: 4%; color: white;">"Datorer behöver i framtiden inte väga mer än 1.5 ton" <br><span id="span1">- Popular Mechanics, 1949</span></h2>
      </div>
    </li>
  </ul>




    <nav class="tab-bar" style="height: 0rem;">
      <section class="right-small" id="navbar-right" >
        <a class="right-off-canvas-toggle menu-icon"><span></span></a>
      </section>
    </nav>
    <aside class="right-off-canvas-menu">
      <ul class="off-canvas-list">
        <li><label>Meny</label></li>
        <li><img src="{{ Auth::user()->profile_img }}" id="profilbild"></li>
        <li id="name">{{ Auth::user()->fname, " ", Auth::user()->lname }}</li>
        <li id="star-side-box"><img src="/img/star.png" id="star-side-bar">{{ $total }}</li>
        <li><a href="{{ URL::route('getLogout') }}">Logga ut</a></li>



        <!-- om admin är inloggad -->
        @if (Auth::user()->isAdmin)
          <li><label>Admin</label></li>
          <li><a href="{{ URL::route('adminIndex') }}">Admin</a></li>
        @endif
      </ul>
    </aside>
    <section class="main-section">
      <div class="row">
        <a href="#" id="scrollup"<i class="fa fa-arrow-up"></i>Top</a>
          <div class="wrap-modules">
            <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3" id="test">
              <?php $number = 1; ?>
              @foreach($modules as $module)
                <li><a href="{{ URL::route('viewChapter', array($module->id, 1)) }}"><div class="module" id="module{{ $number }}"><p>{{ $module->name }} {{ Helpers::getAnswers($module->id) }}</p></div></a></li>
                <?php $number = $number + 1; ?>
              @endforeach
            </ul>
           </div>
      </div>

 <ul class="small-block-grid-1" id="box-under-modules">
  <li>
    <h1>{{ $about->title }}</h1>
    <p>{{ $about->body }}</p>
  </li>
</ul>
    </section>
    <a class="exit-off-canvas"></a>
  </div>
</div>
  
<!-- Här sätter man fasta färger när sidan laddats 
    <script>
      var randomcolor = $('#test .module');
      var original = randomcolor.css('background-color');
      var colors = ['#53ADBA', '#EC539A', '#FBA61F', '#7AB292'];

      randomcolor.each(function () { //mouseover
          var col2 = Math.floor(Math.random() * colors.length);
          var newcolor = colors[col2];
          $(this).css('background-color', newcolor);
      });

      </script>
-->

    <!-- förbereder slumpmässiga färger -->
    <script>
      function get_random_color() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
        color += letters[Math.round(Math.random() * 15)];
        }
        return color;
      }
    </script>

    <script>
      function get_color() {
        var original = randomcolor.css('background-color');
        var colors = ['#53ADBA', '#EC539A', '#FBA61F', '#7AB292'];
      }
    </script>



    <!-- applicerar slumpade färger när man hovrar en modul -->
    <script>
      $(".module").hover(function() {
      $(this).css("background-color", get_random_color());
        }, function() {
          // change back to original color on mouseout
          $(".module").hover(function() {
          $(this).css("background-color", get_color());
          });
      });
    </script>

    <!-- bestämmer när topknappen ska börja osv. -->
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

  @if(isset($correctionResult))
    <script>
      $(document).foundation();
      $(document).ready(function(){$('#myModal').foundation('reveal', 'open')});
    </script>
  @endif
    <!-- kör alla javascripts från foundation -->
  <script>
    $(document).foundation();
  </script>
  
    

@stop