

function my_pmpro_has_membership_access_filter($hasacchess, $post, $user, $levels) {

	// OPEN ACCESS TO SPECIFIED USER ROLES
	if(current_user_can('administrator'))	// Administrator ALWAYS has access
	{
		$hasacchess = true;
	}

	// LOCK CHILD POSTS TO PARENT RESTRICTIONS
	else if(!empty($post->post_parent)) {
		if(pmpro_has_membership_access($post->post_parent, $user->ID)) {
			$hasacchess = true;
		} else {
			$hasacchess = false;
		}
	}

	return $hasacchess;
}
add_filter('pmpro_has_membership_access_filter', 'my_pmpro_has_membership_access_filter', 10, 4);
