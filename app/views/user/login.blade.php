<!doctype html>
<html lang="en">
<head>


 <meta charset="UTF-8">
        
        <!-- Foundation CSS -->
        {{ HTML::style('css/foundation.css') }}
        {{ HTML::style('css/login.css') }}

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        
        <!-- foundation JS -->
        {{ HTML::script('js/vendor/modernizr.js') }}
        {{ HTML::script('js/vendor/jquery.js') }}
        {{ HTML::script('js/foundation/foundation.js') }}
        {{ HTML::script('js/foundation/foundation.magellan.js') }}
        {{ HTML::script('js/foundation/foundation.interchange.js') }}
        {{ HTML::script('js/foundation/foundation.offcanvas.js') }}
        {{ HTML::script('js/foundation/foundation.topbar.js') }}
        {{ HTML::script('js/foundation/foundation.orbit.js') }}
        <!-- Other JS plugins can be included here -->


</head>
<body>

    <div class="row">

        <div class="small-1 medium-2 large-4 left">
            <div class="show-for-large-up" id="ipad-content">
                <img src="/img/ipad.png">
            </div>
        </div>

        <div class="small-1 medium-2 large-4 left">
            <font class="show-for-large-up" id="ipad-text"><p id="ipad-text">Glöm inte bort att du kan kolla på paddan ~</p></font>
            <img class="show-for-large-up" src="/img/logga.png" style="margin-left:auto; margin-right:auto; margin-top: 5%; width:35%; border-radius:20px; ">
        </div>


        <div class="small-12 medium-12 large-4 yellow left">

            <!-- stor skärm -->


            <div class="show-for-large-up" id="login-ruta-stor">
            <p class="show-for-large-up" style="text-align: center; font-style: oblique; font-size: 200%; font-family: cursive; margin-bottom:10%; ">IKT - Olofström</p>
            <a class="show-for-large-up" href="{{ URL::route('auth') }}">Login</a>
            </div>

            <!-- medium skärm -->
            
            <div class="show-for-medium" id="login-ruta-medium">
            <p class="show-for-medium" style="text-align: center; font-style: oblique; font-size: 200%; font-family: cursive; ">IKT - Olofström</p>
            <a class="show-for-medium" href="{{ URL::route('auth') }}">Login</a>
            <fieldset class="switch round medium" id="remember-knapp" tabindex="0">
                <input id="exampleCheckboxSwitch4" type="checkbox">
                <label for="exampleCheckboxSwitch4"></label>
            </fieldset>
            <br>
                <p style="color:#7AB292; width: 100%; text-align: center; font-style: oblique;">Kom ihåg mig?</p>
            </div>

            <!-- liten skärm -->

            <div class="show-for-small" id="login-ruta-liten">
            <p class="show-for-small" style="text-align: center; font-style: oblique; font-size: 200%; font-family: cursive; ">IKT - Olofström</p>
            <a class="show-for-small" href="{{ URL::route('auth') }}">Login</a>
            <fieldset class="switch round medium" id="remember-knapp" tabindex="0">
                <input id="exampleCheckboxSwitch4" type="checkbox">
                <label for="exampleCheckboxSwitch4"></label>
            </fieldset>
            <br>
                <p style="color:#7AB292; width: 100%; text-align: center; font-style: oblique;">Kom ihåg mig?</p>
            </div>         
        </div>
    </div>

    <div class="row" id="footer">
        <div class="small-6 large-6 columns" style="border-right: 2px dotted #333;"><p class="left_text_big"> Relaterade Länkar: </p>
            <p class="left_text_shadow" style="color:blue;"><a href="http://www.olofstrom.se/portal">Olofstöms kommun</a><br><a href="http://www.bth.se/web/utbildning.nsf/sidor/campus-karlshamn">Blekinge Tekniska Högskola</a></p></div>
        <div class="small-6 large-6 columns"><p class="left_text_big2"> Skapad av: </p>
            <p class="left_text_shadow"> Alexander Thuresson, Leo Magnusson, Linda Wannerö, Albin Hammarström, Oliver Möller, Eric Christensen. WU13, WU14 Blekinge Tekniska Högskola, 2015  </p>
        </div>
    </div>

    <div id="background">
        <img class="show-for-large-up" src="/img/blackboard2.jpg">
    </div>   
        


 
    <script>
        $(document).foundation();
    </script>
    @if(Session::has('fail'))
        <script>
            alert("{{ Session::get('fail') }}");
        </script>
    @endif
</body>
</html>
