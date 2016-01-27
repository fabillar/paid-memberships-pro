// FUNCTION TO GET ALL POST IDs ASSOCIATED WITH A LEVEL
// List ALL posts a defined Level ID gives access to...

function pmpro_memberships_posts($level_id) {
	global $wpdb;
	$pmpro_memberships_pages = $wpdb->prefix .'pmpro_memberhips_pages';

	$sqlQuery = $wpdb->prepare("SELECT page_id FROM {$pmpro_memberships_pages} WHERE membership_id = %d", $level_id);
	$pmproPost = $wpdb->get_results($sqlQuery);
	
  	// DETERMINE IF THIS LEVEL IS ASSOCIATED TO A POST or POSTS...
	if (!empty(array_filter($pmproPost))) {
	
	  	// IF YES, POST IDs ARE FOUND...
		foreach($pmproPost as $post) {
		  // MODIFY OUTPUT AS DESIRED...
			echo  "&bull; <a href='" . get_the_permalink($post->page_id) . "'>" . get_the_title($post->page_id) . "</a><br>";
		}
		
	} else {
	  	// IF NO POST IDs WERE FOUND (NO POSTS ASSOCIATED TO THIS LEVEL)...
		echo "This Membership Level is currently not associated with any available posts.";
	}
}
