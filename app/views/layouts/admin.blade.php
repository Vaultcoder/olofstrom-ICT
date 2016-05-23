<!doctype html>
<html lang="en">
<head>

    @section('head')
    
        <meta charset="UTF-8">
        
        <!-- Foundation CSS -->
        {{ HTML::style('css/foundation.css') }}
        {{ HTML::style('css/admin.css') }}
        {{ HTML::style('css/pizza.css') }}
        {{ HTML::style('css/normalize.css') }}
        {{ HTML::style('css/style.css')}}
        {{ HTML::style('css/wysiwyg-editor.css')}}
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        
        <!-- foundation JS -->
        {{ HTML::script('js/vendor/modernizr.js') }}
        {{ HTML::script('js/vendor/jquery.js') }}
        {{ HTML::script('js/foundation/foundation.js') }}
        {{ HTML::script('js/foundation/foundation.interchange.js') }}
        {{ HTML::script('js/foundation/foundation.offcanvas.js') }}
        {{ HTML::script('js/foundation/foundation.reveal.js') }}
        {{ HTML::script('js/foundation/foundation.alert.js') }}
        {{ HTML::script('js/foundation/foundation.dropdown.js') }}
        {{ HTML::script('js/foundation/foundation.tooltip.js') }}
        {{ HTML::script('js/adminJs.js') }}
        {{ HTML::script('js/wysiwyg.js') }}
        {{ HTML::script('js/wysiwyg-editor.js') }}
        
        

		<!-- Other JS plugins can be included here -->

        {{ HTML::script('js/editor.js') }}

		
    @show
    	<script>
			$(document).foundation();
		</script>
</head>
<body>





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
          .on('click.fndtn.offcanvas', '.right-off-canvas-toggle', function (e) {
            self.click_toggle_class(e, 'move-left');
          })
          .on('click.fndtn.offcanvas', '.right-off-canvas-menu a', function (e) {
            var settings = self.get_settings(e)
            if (settings.close_on_click)
              S(".off-canvas-wrap").removeClass("move-left");
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



<!--<div>
	<nav class="top-bar" data-topbar>
				<section class="top-bar-section">
					<ul class="left">
						<li class="has-dropdown not-click"><a href="#">Admin Panel</a>
							<ul class="dropdown">
							<li><a href="http://localhost/">Home</a></li>
							<li><a href="http://localhost/admin/users">Användarhantering</a></li>
							<li><a href="http://localhost/admin/">Modul Statistik</a></li>
							<li><a href="http://localhost/admin/module">Module</a></li>
						
					</ul>
					
				</section>
				
	</nav>
	
</div> -->

<div class="row">
  <div class="small-2 columns">
  <ul class="side-nav">

  
  <li><a href="http://localhost/admin/"><img src="/img/pie-chart-icon.png" 
  style="width:30px; height:30px; margin-right: 5px;">Start Admin</a></li>
  <li><a href="http://localhost/admin/users"><img src="/img/profle-icon.png" 
  style="width:30px; height:30px; margin-right: 5px;">Användare</a></li>
  
  <li><a href="http://localhost/admin/module"><img src="/img/stack-icon.png" 
  style="width:30px; height:30px; margin-right: 5px;">Modul</a></li>
  <li><a href="http://localhost/"><img src="/img/computer-icon.png" 
  style="width:30px; height:30px; margin-right: 5px;">Startsida</a></li>

</ul></div>

  <div class="small-10 columns" style="padding-top:1%; border-left:solid grey 1px;">
    @if(Session::has('fail'))
      <div data-alert class="alert-box alert">
          {{ Session::get('fail') }}
        <a href="#" class="close">&times;</a>
      </div>
    @endif 
    @if(Session::has('success')) 
      <div data-alert class="alert-box">
          {{ Session::get('success') }}
        <a href="#" class="close">&times;</a>
      </div>
    @endif
  @yield('content')</div>

  

</div>

</body>
</html>
