$(document).ready(function(){

    // Full featured editor
    $('#editor1').each( function(index, element)
    {
        $(element).wysiwyg({
            classes: 'some-more-classes',
            // 'selection'|'top'|'top-selection'|'bottom'|'bottom-selection'
            toolbar: index == 0 ? 'top-selection' : (index == 1 ? 'bottom' : 'selection'),
            buttons: {
                // Dummy-HTML-Plugin
                dummybutton1: index != 1 ? false : {
                    html: $('<input id="submit" type="button" value="bold" />').click(function(){
                                // We simply make 'bold'
                                if( $(element).wysiwyg('shell').getSelectedHTML() )
                                    $(element).wysiwyg('shell').bold();
                                else
                                    alert( 'Please selection some text' );
                            }),
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                // Dummy-Button-Plugin
                dummybutton2: index != 1 ? false : {
                    title: 'Dummy',
                    image: '\uf1e7',
                    click: function( $button ) {
                            alert('Do something');
                           },
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                // Smiley plugin
                smilies: {
                    title: 'Smilies',
                    image: '\uf118', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    popup: function( $popup, $button ) {
                            var list_smilies = [
                                    '<img src="/img/smiley/afraid.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/amorous.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/angel.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/angry.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/bored.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/cold.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/confused.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/cross.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/crying.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/devil.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/disappointed.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/dont-know.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/drool.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/embarrassed.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/excited.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/excruciating.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/eyeroll.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/happy.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/hot.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/hug-left.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/hug-right.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/hungry.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/invincible.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/kiss.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/lying.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/meeting.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/nerdy.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/neutral.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/party.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/pirate.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/pissed-off.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/question.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/sad.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/shame.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/shocked.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/shut-mouth.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/sick.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/silent.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/sleeping.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/sleepy.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/stressed.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/thinking.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/tongue.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/uhm-yeah.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/wink.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/working.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/bathing.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/beer.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/boy.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/camera.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/chilli.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/cigarette.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/cinema.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/coffee.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/girl.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/console.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/grumpy.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/in_love.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/internet.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/lamp.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/mobile.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/mrgreen.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/musical-note.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/music.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/phone.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/plate.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/restroom.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/rose.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/search.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/shopping.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/star.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/studying.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/suit.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/surfing.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/thunder.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/tv.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/typing.png" width="16" height="16" alt="" />',
                                    '<img src="/img/smiley/writing.png" width="16" height="16" alt="" />'
                            ];
                            var $smilies = $('<div/>').addClass('wysiwyg-toolbar-smilies')
                                                      .attr('unselectable','on');
                            $.each( list_smilies, function(index,smiley){
                                if( index != 0 )
                                    $smilies.append(' ');
                                var $image = $(smiley).attr('unselectable','on');
                                // Append smiley
                                var imagehtml = ' '+$('<div/>').append($image.clone()).html()+' ';
                                $image
                                    .css({ cursor: 'pointer' })
                                    .click(function(event){
                                        $(element).wysiwyg('shell').insertHTML(imagehtml); // .closePopup(); - do not close the popup
                                    })
                                    .appendTo( $smilies );
                            });
                            var $container = $(element).wysiwyg('container');
                            $smilies.css({ maxWidth: parseInt($container.width()*0.95)+'px' });
                            $popup.append( $smilies );
                            // Smilies do not close on click, so force the popup-position to cover the toolbar
                            var $toolbar = $button.parents( '.wysiwyg-toolbar' );
                            if( ! $toolbar.length ) // selection toolbar?
                                return ;
                            return { // this prevents applying default position
                                left: parseInt( ($toolbar.outerWidth() - $popup.outerWidth()) / 2 ),
                                top: $toolbar.hasClass('wysiwyg-toolbar-bottom') ? ($container.outerHeight() - parseInt($button.outerHeight()/4)) : (parseInt($button.outerHeight()/4) - $popup.height())
                            };
                           },
                    //showstatic: true,    // wanted on the toolbar
                    showselection: index == 2 ? true : false    // wanted on selection
                },
                insertimage: {
                    title: 'Insert image',
                    image: '\uf030', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: index == 2 ? true : false    // wanted on selection
                },
                insertvideo: {
                    title: 'Insert video',
                    image: '\uf03d', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: index == 2 ? true : false    // wanted on selection
                },
                insertlink: {
                    title: 'Insert link',
                    image: '\uf08e' // <img src="path/to/image.png" width="16" height="16" alt="" />
                },
                // Fontname plugin
                fontname: index == 1 ? false : {
                    title: 'Font',
                    image: '\uf031', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    popup: function( $popup, $button ) {
                            var list_fontnames = {
                                    // Name : Font
                                    'Arial, Helvetica' : 'Arial,Helvetica',
                                    'Verdana'          : 'Verdana,Geneva',
                                    'Georgia'          : 'Georgia',
                                    'Courier New'      : 'Courier New,Courier',
                                    'Times New Roman'  : 'Times New Roman,Times'
                                };
                            var $list = $('<div/>').addClass('wysiwyg-toolbar-list')
                                                   .attr('unselectable','on');
                            $.each( list_fontnames, function( name, font ){
                                var $link = $('<a/>').attr('href','#')
                                                    .css( 'font-family', font )
                                                    .html( name )
                                                    .click(function(event){
                                                        $(element).wysiwyg('shell').fontName(font).closePopup();
                                                        // prevent link-href-#
                                                        event.stopPropagation();
                                                        event.preventDefault();
                                                        return false;
                                                    });
                                $list.append( $link );
                            });
                            $popup.append( $list );
                           },
                    //showstatic: true,    // wanted on the toolbar
                    showselection: index == 0 ? true : false    // wanted on selection
                },
                // Fontsize plugin
                fontsize: index != 1 ? false : {
                    title: 'Size',
                    image: '\uf034', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    popup: function( $popup, $button ) {
                            /*
                            var list_fontsizes = {
                                // Name : Size
                                'Huge'    : 7,
                                'Larger'  : 6,
                                'Large'   : 5,
                                'Normal'  : 4,
                                'Small'   : 3,
                                'Smaller' : 2,
                                'Tiny'    : 1
                            };
                            var $list = $('<div/>').addClass('wysiwyg-toolbar-list')
                                                   .attr('unselectable','on');
                            $.each( list_fontsizes, function( name, size ){
                                var $link = $('<a/>').attr('href','#')
                                                    .css( 'font-size', (8 + (size * 3)) + 'px' )
                                                    .html( name )
                                                    .click(function(event){
                                                        $(element).wysiwyg('shell').fontSize(size).closePopup();
                                                        // prevent link-href-#
                                                        event.stopPropagation();
                                                        event.preventDefault();
                                                        return false;
                                                    });
                                $list.append( $link );
                            });
                            $popup.append( $list );
                            */
                            // Hack: http://stackoverflow.com/questions/5868295/document-execcommand-fontsize-in-pixels/5870603#5870603
                            var list_fontsizes = [];
                            for( var i=8; i <= 11; ++i )
                                list_fontsizes.push(i+'px');
                            for( var i=12; i <= 28; i+=2 )
                                list_fontsizes.push(i+'px');
                            list_fontsizes.push('36px');
                            list_fontsizes.push('48px');
                            list_fontsizes.push('72px');
                            var $list = $('<div/>').addClass('wysiwyg-toolbar-list')
                                                   .attr('unselectable','on');
                            $.each( list_fontsizes, function( index, size ){
                                var $link = $('<a/>').attr('href','#')
                                                    .html( size )
                                                    .click(function(event){
                                                        $(element).wysiwyg('shell').fontSize(7).closePopup();
                                                        $(element).wysiwyg('container')
                                                                .find('font[size=7]')
                                                                .removeAttr("size")
                                                                .css("font-size", size);
                                                        // prevent link-href-#
                                                        event.stopPropagation();
                                                        event.preventDefault();
                                                        return false;
                                                    });
                                $list.append( $link );
                            });
                            $popup.append( $list );
                           }
                    //showstatic: true,    // wanted on the toolbar
                    //showselection: true    // wanted on selection
                },
                // Header plugin
                header: index != 1 ? false : {
                    title: 'Header',
                    image: '\uf1dc', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    popup: function( $popup, $button ) {
                            var list_headers = {
                                    // Name : Font
                                    'Header 1' : '<h1>',
                                    'Header 2' : '<h2>',
                                    'Header 3' : '<h3>',
                                    'Header 4' : '<h4>',
                                    'Header 5' : '<h5>',
                                    'Header 6' : '<h6>',
                                    'Code'     : '<pre>'
                                };
                            var $list = $('<div/>').addClass('wysiwyg-toolbar-list')
                                                   .attr('unselectable','on');
                            $.each( list_headers, function( name, format ){
                                var $link = $('<a/>').attr('href','#')
                                                     .css( 'font-family', format )
                                                     .html( name )
                                                     .click(function(event){
                                                        $(element).wysiwyg('shell').format(format).closePopup();
                                                        // prevent link-href-#
                                                        event.stopPropagation();
                                                        event.preventDefault();
                                                        return false;
                                                    });
                                $list.append( $link );
                            });
                            $popup.append( $list );
                           }
                    //showstatic: true,    // wanted on the toolbar
                    //showselection: false    // wanted on selection
                },
                bold: {
                    title: 'Bold (Ctrl+B)',
                    image: '\uf032', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 'b'
                },
                italic: {
                    title: 'Italic (Ctrl+I)',
                    image: '\uf033', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 'i'
                },
                underline: {
                    title: 'Underline (Ctrl+U)',
                    image: '\uf0cd', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 'u'
                },
                strikethrough: {
                    title: 'Strikethrough (Ctrl+S)',
                    image: '\uf0cc', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 's'
                },
                forecolor: {
                    title: 'Text color',
                    image: '\uf1fc' // <img src="path/to/image.png" width="16" height="16" alt="" />
                },
                highlight: {
                    title: 'Background color',
                    image: '\uf043' // <img src="path/to/image.png" width="16" height="16" alt="" />
                },
                alignleft: index != 0 ? false : {
                    title: 'Left',
                    image: '\uf036', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                aligncenter: index != 0 ? false : {
                    title: 'Center',
                    image: '\uf037', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                alignright: index != 0 ? false : {
                    title: 'Right',
                    image: '\uf038', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                alignjustify: index != 0 ? false : {
                    title: 'Justify',
                    image: '\uf039', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                subscript: index == 1 ? false : {
                    title: 'Subscript',
                    image: '\uf12c', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: true    // wanted on selection
                },
                superscript: index == 1 ? false : {
                    title: 'Superscript',
                    image: '\uf12b', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: true    // wanted on selection
                },
                indent: index != 0 ? false : {
                    title: 'Indent',
                    image: '\uf03c', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                outdent: index != 0 ? false : {
                    title: 'Outdent',
                    image: '\uf03b', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                orderedList: index != 0 ? false : {
                    title: 'Ordered list',
                    image: '\uf0cb', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                unorderedList: index != 0 ? false : {
                    title: 'Unordered list',
                    image: '\uf0ca', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                removeformat: {
                    title: 'Remove format',
                    image: '\uf12d' // <img src="path/to/image.png" width="16" height="16" alt="" />
                }
            },
            // Submit-Button
            submit: {
                title: 'Submit',
                image: '\uf00c' // <img src="path/to/image.png" width="16" height="16" alt="" />
            },
            // Other properties
            selectImage: 'För att ladda upp en bild:</br>* Sök efter din bild på önskad sökmotor </br>* Högerklicka på bilden </br>* Klicka kopiera bildwebbadress </br>* Klistra in i fältet</br>',
            placeholderUrl: 'www.example.com',
            placeholderEmbed: '<embed/>',
            maxImageSize: [600,200],
            /*
            onImageUpload: function( insert_image ) {
                            // Used to insert an image without XMLHttpRequest 2
                            // A bit tricky, because we can't easily upload a file
                            // via '$.ajax()' on a legacy browser.
                            // You have to submit the form into to a '<iframe/>' element.
                            // Call 'insert_image(url)' as soon as the file is online
                            // and the URL is available.
                            // Best way to do: http://malsup.com/jquery/form/
                            // For example:
                            //$(this).parents('form')
                            //       .attr('action','/path/to/file')
                            //       .attr('method','POST')
                            //       .attr('enctype','multipart/form-data')
                            //       .ajaxSubmit({
                            //          success: function(xhrdata,textStatus,jqXHR){
                            //            var image_url = xhrdata;
                            //            console.log( 'URL: ' + image_url );
                            //            insert_image( image_url );
                            //          }
                            //        });
                        },*/
            videoFromUrl: function( url ) {
                // Contributions are welcome :-)

                // youtube - http://stackoverflow.com/questions/3392993/php-regex-to-get-youtube-video-id
                var youtube_match = url.match( /^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?(?:youtu\.be|youtube\.com)\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/)([^\?&\"'>]+)/ );
                if( youtube_match && youtube_match[1].length == 11 )
                    return '<div class="flex-video"><iframe src="//www.youtube.com/embed/' + youtube_match[1] + '" width="640" height="360" frameborder="0" allowfullscreen></iframe></div>';

                // vimeo - http://embedresponsively.com/
                var vimeo_match = url.match( /^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?vimeo\.com\/([0-9]+)$/ );
                if( vimeo_match )
                    return '<div class="flex-video"><iframe src="//player.vimeo.com/video/' + vimeo_match[1] + '" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';

                // dailymotion - http://embedresponsively.com/
                var dailymotion_match = url.match( /^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?dailymotion\.com\/video\/([0-9a-z]+)$/ );
                if( dailymotion_match )
                    return '<div class="flex-video"><iframe src="//www.dailymotion.com/embed/video/' + dailymotion_match[1] + '" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';

                // undefined -> create '<video/>' tag
            },
            onKeyPress: function( code, character, shiftKey, altKey, ctrlKey, metaKey ) {
                            // E.g.: submit form on enter-key:
                            //if( (code == 10 || code == 13) && !shiftKey && !altKey && !ctrlKey && !metaKey ) {
                            //    submit_form();
                            //    return false; // swallow enter
                            //}
                        }
        })
        .change(function(){
            if( typeof console != 'undefined' )
                console.log( 'change' );
        })
        .focus(function(){
            if( typeof console != 'undefined' )
                console.log( 'focus' );
        })
        .blur(function(){
            if( typeof console != 'undefined' )
                console.log( 'blur' );
        });
    });

    // Demo-Buttons
    $('#editor3-bold').click(function(){
        $('#editor3').wysiwyg('shell').bold();
        return false;
    });
    $('#editor3-red').click(function(){
        $('#editor3').wysiwyg('shell').highlight('#ff0000');
        return false;
    });
    $('#editor3-sethtml').click(function(){
        $('#editor3').wysiwyg('shell').setHTML('This is the new text.');
        return false;
    });
    $('#editor3-inserthtml').click(function(){
        $('#editor3').wysiwyg('shell').insertHTML('Insert some text.');
        return false;
    });

    // Raw editor
    var option = {
        element: $('#editor0').get(0),
        onkeypress: function( code, character, shiftKey, altKey, ctrlKey, metaKey ) {
                        if( typeof console != 'undefined' )
                            console.log( 'RAW: '+character+' key pressed' );
                    },
        onselection: function( collapsed, rect, nodes, rightclick ) {
                        if( typeof console != 'undefined' && rect )
                            console.log( 'RAW: selection rect('+rect.left+','+rect.top+','+rect.width+','+rect.height+'), '+nodes.length+' nodes' );
                    },
        onplaceholder: function( visible ) {
                        if( typeof console != 'undefined' )
                            console.log( 'RAW: placeholder ' + (visible ? 'visible' : 'hidden') );
                    }
    };
    var wysiwygeditor = wysiwyg( option );
    //wysiwygeditor.setHTML( '<html>' );
});