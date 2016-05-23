<!doctype html>
<html lang="en">
<head>

    @section('head')

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        
        <!-- Foundation CSS -->
        {{ HTML::style('css/foundation.css') }}
        {{ HTML::style('css/style.css') }}
        {{ HTML::style('css/bounce.css') }}
        {{ HTML::style('css/pizza.css') }}
      

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        
        
        <!-- foundation JS -->
        {{ HTML::script('js/vendor/modernizr.js') }}
        {{ HTML::script('js/vendor/jquery.js') }}
        {{ HTML::script('js/foundation/foundation.js') }}
        {{ HTML::script('js/foundation/foundation.reveal.js') }}
        {{ HTML::script('js/foundation/foundation.magellan.js') }}
        {{ HTML::script('js/foundation/foundation.interchange.js') }}
        {{ HTML::script('js/foundation/foundation.tab.js') }}
        {{ HTML::script('js/foundation/foundation.offcanvas.js') }}
        {{ HTML::script('js/foundation/foundation.topbar.js') }}
        {{ HTML::script('js/foundation/foundation.orbit.js') }}





    <!-- Other JS plugins can be included here -->





		<script>
			$(document).foundation();
		</script>


		


        @show
</head>
<body>

<script type="text/javascript">
function checkAnswer()
{
  var x = document.getElementsByTagName('input'); // Tar fram namn med specifikt namn
  for (var i=0;i<x.length;i++)
  {
    {if (x[i].type == 'check') {x[i].click();}}; alert
    {
       if (x[i].checked) {return true}
    }
  }
  if (x[i].undefined) {return false}
    {
      alert("Du måste ange minst ett svar!");
      
  }
}

<script >
  ;(function ($, window, document, undefined) {
  'use strict';

  Foundation.libs.offcanvas = {
    name : 'offcanvas',

    version : '5.2.2',

    settings : {
      open_method: 'overlap',
      close_on_click: true  
    },

    init : function (scope, method, options) {
      this.bindings(method, options);
    },

    events : function () {
      var self = this,
          S = self.S;
      if (this.settings.open_method === 'move'){
        S(this.scope).off('.offcanvas')
          .on('click.fndtn.offcanvas', '.left-off-canvas-toggle', function (e) {
            self.click_toggle_class(e, 'move-right');
          })
          .on('click.fndtn.offcanvas', '.left-off-canvas-menu a', function (e) {
            var settings = self.get_settings(e)
            if (settings.close_on_click)
              S(".off-canvas-wrap").removeClass("move-right");
          })
          
         
          .on('click.fndtn.offcanvas', '.exit-off-canvas', function (e) {
            self.click_remove_class(e, 'move-left');
            self.click_remove_class(e, 'move-right');
          })
      } else if (this.settings.open_method === 'overlap') {
        S(this.scope).off('.offcanvas')
          .on('click.fndtn.offcanvas', '.left-off-canvas-toggle', function (e) {
            self.click_toggle_class(e, 'offcanvas-overlap');
          })
          .on('click.fndtn.offcanvas', '.left-off-canvas-menu a', function (e) {
            var settings = self.get_settings(e)
            if (settings.close_on_click)
              S(".off-canvas-wrap").removeClass("offcanvas-overlap");
          })
          .on('click.fndtn.offcanvas', '.right-off-canvas-toggle', function (e) {
            self.click_toggle_class(e, 'offcanvas-overlap');
          })
          .on('click.fndtn.offcanvas', '.right-off-canvas-menu a', function (e) {
            var settings = self.get_settings(e)
            if (settings.close_on_click)
              S(".off-canvas-wrap").removeClass("offcanvas-overlap");
          })
          .on('click.fndtn.offcanvas', '.exit-off-canvas', function (e) {
            self.click_remove_class(e, 'offcanvas-overlap');
            self.click_remove_class(e, 'offcanvas-overlap');
          })
      } else {
        return;
      }
    },

    click_toggle_class: function(e, class_name) {
      e.preventDefault();
      this.S(e.target).closest('.off-canvas-wrap').toggleClass(class_name);
    },

    click_remove_class: function(e, class_name) {
      e.preventDefault();
      this.S('.off-canvas-wrap').removeClass(class_name);
    },

    get_settings: function(e) {
      var offcanvas = this.S(e.target).closest('[' + this.attr_name() + ']')
      return offcanvas.data(this.attr_name(true) + '-init') || this.settings;
    },

    reflow : function () {}
  };
}(jQuery, window, window.document));

$(document).foundation();
</script>




    
    <div class="row">@yield('content')</div>
  

  
    </div>

      <div class="row" id="footer">
        <div class="small-6 large-6 columns" style="border-right: 2px dotted #333;"><p class="left_text_big"> Relaterade Länkar: </p>
            <p class="left_text_shadow" style="color:blue;"><a href="http://www.olofstrom.se/portal">Olofstöms kommun</a><br><a href="http://www.bth.se/web/utbildning.nsf/sidor/campus-karlshamn">Blekinge Tekniska Högskola</a></p></div>
        <div class="small-6 large-6 columns"><p class="left_text_big2"> Skapad av: </p>
            <p class="left_text_shadow"> Alexander Thuresson, Leo Magnusson, Linda Wannerö, Albin Hammarström, Oliver Möller, Eric Christensen. WU13, WU14 Blekinge Tekniska Högskola, 2015  </p>
        </div>
      </div>
      
</body>
</html>
