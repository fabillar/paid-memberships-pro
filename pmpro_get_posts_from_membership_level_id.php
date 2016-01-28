// FUNCTION TO GET ALL POST IDs ASSOCIATED WITH A LEVEL
// List ALL posts a defined Level ID gives access to...

function pmpro_memberships_posts($level_id) {

	// CHECK IF $level_id PARAMETER IS DEFINED
	if($level_id) {
		global $wpdb;
		$pmpro_memberships_pages = $wpdb->prefix .'pmpro_memberships_pages';
		$disallowed_posts = array("trash", "inherit", "draft", "auto-draft"); // POSTS NOW TO SHOW

		$sqlQuery = $wpdb->prepare("SELECT page_id FROM {$pmpro_memberships_pages} WHERE membership_id = %d", $level_id);
		$pmproPost = $wpdb->get_results($sqlQuery);
		
	  	// DETERMINE IF THIS LEVEL IS ASSOCIATED TO A POST or POSTS...
		if (!empty(array_filter($pmproPost))) {
		
		  	// IF YES, POST ID/IDs ARE FOUND...
			foreach($pmproPost as $post) {

			  	// MAKE SURE POSTS ARE PUBLISHED...
				if (get_post_status($post->page_id) == 'publish') {

					// DISPLAY PUBLISHED POSTS ASSOCIATED TO THIS LEVEL
					// MODIFY OUTPUT AS DESIRED...
					echo  "&bull; <a href='" . get_the_permalink($post->page_id) . "'>" . get_the_title($post->page_id) . "</a><br>";
					
				} else {

					// CHECK FOR OTHER ALLOWED POSTS STATUSES, ASIDE FROM "PUBLISHED"...
					if (!in_array(get_post_status($post->page_id), $disallowed_posts)) {

						// UNPUBLISHED POSTS ASSOCIATED TO THIS LEVEL...
						// (If you want to show them, e.g. Pending, Future, Private posts...)
						echo "&bull; " . ucwords(get_post_status($post->page_id)) . " : " . get_the_title($post->page_id) . "</br>";
					}
				}
			}
		} else {
		  	// IF NO POST IDs WERE FOUND (NO POSTS ASSOCIATED TO THIS LEVEL)...
			echo "This Membership Level is currently not associated with any available posts.";
		}
	}
}
