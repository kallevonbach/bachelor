<?php /*
		function grantpermission($userid, $groupId) {
		if ( !current_user_can( 'manage_options' ) ) {
			wp_die( 'You are not allowed to be on this page.' );
   		}
   		// Check that nonce field
   		check_admin_referer( 'verify' );
		
		$userid = sanitize_text_field( $_POST['userid'] );
		$groupId = sanitize_text_field( $_POST['groupId'] );
		
		$usermeta = get_user_meta($userid);
		$usermetagrupper = $usermeta['Gruppe_medlemskaber'];
		$unserializeddata = unserialize($usermetagrupper[0]);	
		array_push($unserializeddata, $groupId);
			
			if (!in_array($groupId, $unserializeddata)) {
				update_user_meta( $userid, 'Gruppe_medlemskaber',  $unserializeddata);			
				$userindex = array_search($userid, $currentPermissionsArray[$groupId]);
				unset($currentPermissionsArray[$groupId][$userindex]);
				update_option( 'groups_requests', $currentPermissionsArray );
			}
		
		wp_redirect(  admin_url( 'edit.php?post_type=grupper_post&page=grupper-administration' ) );
		
		}	
	*/
	 ?>	 