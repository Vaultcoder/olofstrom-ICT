jQuery( document ).ready( function( $ ) {
 
    $( '#form-search' ).on( 'submit', function() {
        //.....
        //show some spinner etc to indicate operation in progress
        //.....
 
        $.post(
            $( this ).prop( 'action' ),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "search": $( '#search' ).val()
            },
            function( data ) {
                var len = Object.keys(data).length;
                for(var a = 0; a < len; a++) {
                    console.log('Namn:' + data[a].fname + ' , Efternamn: ' + data[a].lname + ', Email: ' + data[a].email);
                }
            },
            'json'
        );
 
        //.....
        //do anything else you might want to do
        //.....
 
        //prevent the form from actually submitting in browser
        return false;
    } );
 
} );