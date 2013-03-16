jQuery(document).ready(function(){

	// Lightbox
	jQuery( '.zoom, .gallery a' ).click(function(e) {
        //prevent default action (hyperlink)
        e.preventDefault();
        //Get clicked link href
        var image_href = jQuery(this).attr("href");
        /*
        If the lightbox window HTML already exists in document,
        change the img src to to match the href of whatever link was clicked
        If the lightbox window HTML doesn't exists, create it and insert it.
        (This will only happen the first time around)
        */
        if (jQuery('#lightbox').length > 0) { // #lightbox exists
            //place href as img src value
            jQuery('#lightboxcontent').html('<img src="' + image_href + '" />');
            //show lightbox window - you could use .show('fast') for a transition
            jQuery('#lightbox').show();
        }
        else { //#lightbox does not exist - create and insert (runs 1st time only)
            //create HTML markup for lightbox window
            var lightbox =
            '<div id="lightbox">' +
                //'<p>Click to close</p>' +
                '<div id="lightboxcontent">' + //insert clicked link's href into img src
                    '<img src="' + image_href +'" />' +
                '</div>' +
            '</div>';
            //insert lightbox HTML into page
            jQuery('body').append(lightbox);
        }
    });
    //Click anywhere on the page to get rid of lightbox window
    jQuery( '#lightbox' ).live('click', function() { //must use live, as the lightbox element is inserted into the DOM
        jQuery( '#lightbox' ).hide();
    });

	// Avoid widows in headings
	jQuery( 'h1.title a, .single h1.title, .logo-wrap h1, #logo' ).each(function(){var wordArray=jQuery(this).text().split(" ");var finalTitle="";for(i=0;i<=wordArray.length-1;i++){finalTitle+=wordArray[i];if(i==(wordArray.length-2)){finalTitle+="&nbsp;"}else{finalTitle+=" "}}jQuery(this).html(finalTitle)});

	// Fire fitvids
	jQuery( '.wrapper' ).fitVids();

    // Add .parent class to appropriate menu items
    jQuery( 'ul.sub-menu' ).parent().addClass( 'parent' );

    /**
     * Navigation
     */
    // Add the 'show-nav' class to the body when the nav toggle is clicked
    jQuery( '.nav-toggle' ).click(function(e) {

        // Prevent default behaviour
        e.preventDefault();

        // Add the 'show-nav' class
        jQuery( 'body' ).toggleClass( 'show-nav' );

    });

    // Remove the 'show-nav' class from the body when the nav-close anchor is clicked
    jQuery('.nav-close').click(function(e) {

        // Prevent default behaviour
        e.preventDefault();

        // Remove the 'show-nav' class
        jQuery( 'body' ).removeClass( 'show-nav' );
    });

    // Remove the 'show-nav' class from the body when the use clicks (taps) outside #navigation
    var hasParent = function(el, id) {
        if (el) {
            do {
                if (el.id === id) {
                    return true;
                }
                if (el.nodeType === 9) {
                    break;
                }
            }
            while((el = el.parentNode));
        }
        return false;
    };
    document.addEventListener('touchstart', function(e) {
        if ( jQuery( 'body' ).hasClass( 'show-nav' ) && !hasParent( e.target, 'navigation' ) ) {

            // Prevent default behaviour
            e.preventDefault();

            // Remove the 'show-nav' class
            jQuery( 'body' ).removeClass( 'show-nav' );
        }
    },
    true);

    // Scroll to top
    jQuery(function () {
        jQuery( '.back-to-top' ).click(function () {
            jQuery( 'body,html' ).animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });

});