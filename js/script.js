jQuery(document).ready(function(){
		
	// Lightbox
	jQuery('.zoom').click(function(e) {
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
    jQuery('#lightbox').live('click', function() { //must use live, as the lightbox element is inserted into the DOM
        jQuery('#lightbox').hide();
    });
	
	// Avoid widows in headings
	jQuery("h1.title a, .single h1.title, .logo-wrap h1, #logo").each(function(){var wordArray=jQuery(this).text().split(" ");var finalTitle="";for(i=0;i<=wordArray.length-1;i++){finalTitle+=wordArray[i];if(i==(wordArray.length-2)){finalTitle+="&nbsp;"}else{finalTitle+=" "}}jQuery(this).html(finalTitle)});
	
	// Fire fitvids
	jQuery(".wrapper").fitVids();
		
});