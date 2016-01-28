// FUNCTION TO GET LEVEL ID FROM $level_name (parameter)
// Useful for when you don't have the level object to supply the level ID...
// Or When you match user roles or post/page titles to your Membership Level names, or whatever instances applicable... :P
// USAGE: <?php echo pmpro_get_levelID_fromName($level_name); ?>

function pmpro_get_levelID_fromName($level_name) {

	// CHECK IF $level_name PARAMETER IS DEFINED
	if ($level_name) {
		global $wpdb;
	  	$pmpro_membership_levels = $wpdb->prefix .'pmpro_membership_levels';

		$sqlQuery = $wpdb->prepare("SELECT id FROM {$pmpro_membership_levels} WHERE name = %s", $level_name);
		$pmproLevelID = $wpdb->get_col($sqlQuery);

	  	// DETERMINE IF THIS LEVEL NAME MATCHES A LEVEL ID...
		if (!empty(array_filter($pmproLevelID))) {

			// OUTPUT ID HERE...
			foreach($pmproLevelID as $id) { echo $id; }
		}
	}
}
