<!-- Get the master layout -->
@extends('layouts.admin')

<!-- Change title for home page with section -->
@section('head')
    @parent
    
    <title>Användarhantering</title>

    {{ HTML::script('js/search.js') }}
@stop

<!-- Add some words into the content section -->
@section('content')


  <!-- content header -->
<div class="row">
<div class="small-12 columns">
<div class="headerdiv headerdivtext">Användarhantering</div>
<br />
<br />
<li><a href="{{ URL::route('addXml') }}" class="button small">Lägg XML dokument med användare</a></li>
    <br />
    <li><a href="{{ URL::route ('addUser') }}" class="button small">Lägg till Användare</a></li>
</div>
<br />

    <section class="main-section">
          <div class="wrap-modules1">
<div class="medium-4 columns">

<br />
</div>

<div class="medium-8 columns"><section class="main-section">

{{ Form::open(array('route' => 'postSearch')) }}
    {{ Form::text('search', null, array('placeholder' => 'Sök på namn, efternamn, email', 'class' => 'searchbox')) }}
    {{ Form::submit('Sök', array('class' => 'button tiny searchbutton')) }}
    {{ Form::close() }}    

<a href="#" class="arrow">&laquo;</a>
@for($i = 0; $i < $pages; $i++)
    
  <a href="{{ URL::route('getUsers', $i) }}" id="pagenumbers">{{ $i+1 }}</a>

@endfor
<a href="#" class="arrow">&raquo;</a>
   <div id="showusers">
        <table class="center">
            <tr>
                <th>Namn</th>
                <th>Efternamn</th>
                <th>Email</th>
            </tr> 
            @foreach($users as $user)
            <tr>
                <td>{{ $user->fname }}</td>
                <td> {{ $user->lname}}</td>
                <td>{{ $user->email }}</td>
                
                <td><a class="editUserLink" href="{{ URL::action ('AdminController@editUser', [$user->id]) }}">Redigera</a></td>
                <td><a href="{{ URL::action ('AdminController@postRemoveUser', [$user->id]) }}" >Radera</a></td>
            </tr>
            @endforeach  
        </table>  
    </div>
<a href="#" class="arrow">&laquo;</a>
@for($i = 0; $i < $pages; $i++)
    
  <a href="{{ URL::route('getUsers', $i) }}" id="pagenumbers">{{ $i+1 }}</a>

@endfor
<a href="#" class="arrow">&raquo;</a>

<div class='reveal-modal' id='userModal' data-reveal></div>
    
<script type="text/javascript">
    $(document).ready(function(){
        $(".editUserLink, #addUserButton").click(function(e){
            e.preventDefault();
            e.stopPropagation();
            $('#userModal').foundation('reveal', 'open', $(this).attr("href"));
        });
    });
</script>

</ul>
    </div>

</div>
    </div>



    <script>
      $(document).foundation();
    </script>
  

    

@stop