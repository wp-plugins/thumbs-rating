function thumbs_rating_vote(ID, type)
{
	// For the LocalStorage 
	
	var itemName = "thumbsrating" + ID;
	
	// Check if the LocalStorage value exist. If do nothing.
	
	if (!localStorage.getItem(itemName)){
	
		// Data for the Ajax Request
		
		var data = {
			action: 'thumbs_rating_add_vote',
			postid: ID,
			type: type
		};
			
		jQuery.post(thumbs_rating_ajax.ajax_url, data, function(response) {
	
			var container = '#thumbs-rating-' + ID;
			
			var object = jQuery(container);
			
			jQuery(container).html('');
			
			jQuery(container).append(response);
			
			// Remove the class and ID so we don't have 2 DIVs with the same ID
			
			jQuery(object).removeClass('thumbs-rating-container');
			jQuery(object).attr('id', '');
			
			// Set HTML5 LocalStorage so the user can not vote again unless he clears it.
			
			var itemName = "thumbsrating" + ID;
			
			localStorage.setItem(itemName, true);
	
		});
	}else{

		// Display message if we detect LocalStorage
		
		jQuery('#thumbs-rating-' + ID + ' .thumbs-rating-already-voted').fadeIn().css('display', 'block');
	}
}