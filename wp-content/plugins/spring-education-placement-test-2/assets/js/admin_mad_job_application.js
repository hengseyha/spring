/*
 * A custom function that checks if element is in array, we'll need it later
 */
 
jQuery( function( $ ) {
	
    $('.add_cv_attached_btn').click( function(e){ 
        /* on button click*/
		e.preventDefault();
 
		var button = $(this),
	    	custom_uploader = wp.media({
			title: 'Insert CV', /* popup title */
			library : {type : 'application/pdf'},
			button: {text: 'Insert CV'}, /* "Insert" button text */
			multiple: false
		    }).on('select', function() {
			    var attachments = custom_uploader.state().get('selection').map(function( a ) {
                                        a.toJSON();
                                        return a;
                                    }),
			        i;

                    for (i = 0; i < attachments.length; ++i) {
                        let cv_link = '<div class="application-cv"><p><a href="'+attachments[i].attributes.url+'" target="_blank">View CV</a></p></div>';
                        $('div.cv_wrapper').empty();
                        $('div.cv_wrapper').append( cv_link );
                        $('.add_cv_attached_btn').text('Update Your CV');
                        $('#job_application_cv').val(attachments[i].id);
                    }
		}).open();
	});
    
  
});