<?php 
    
    $currentPermissionsArray = get_option('groups_requests');
    
    
    foreach ($currentPermissionsArray as $groupId => $requestArray ) {
    $groupInformation = get_term( $groupId, 'grupper_tax' );
    $verify = wp_nonce_field( 'verify' );       
        echo '<h2 class="grupper-h2">' . $groupInformation->name . '</h2> ';
        echo '<table cellspacing="0" class="user-list"><tr><th>Navn</th><th>Email</th><th></th></tr>';
        if (empty($requestArray)) {
            echo '<tr><td style="width:100%">Ingen brugere har ansøgt denne gruppe...</td></tr>';
       } else{
            foreach ($requestArray as $userid ) {
                $user = get_user_by( 'id', $userid );
                echo '<tr><td>' . $user->display_name . '</td><td>' . $user->user_login  . '</td>';
                echo '<td class="buttons"><div class="floating"><form class="grupper-form" method="POST" action="' . esc_url( admin_url('admin-post.php') ) .'">';
                echo '<input type="hidden" name="action" value="grantpermission" />';
                echo $verify . '<input type="text" class="hidden" name="userid" value="' . $userid . '"/>';
                echo '<input type="text" class="hidden" name="groupId" value="' . $groupId . '"/>';
                echo '<input type="submit" value="Accepter" class="accept"/></form>';
                echo '<form class="grupper-form" method="POST" action="' . esc_url( admin_url('admin-post.php') ) .'">';
                echo '<input type="hidden" name="action" value="denypermission" />';
                echo $verify . '<input type="text" class="hidden" name="userid" value="' . $userid . '"/>';
                echo '<input type="text" class="hidden" name="groupId" value="' . $groupId . '"/>';
                echo '<input type="submit" value="Fjern" class="deny"/></form></div></td></tr>';
            }
       }
        echo '</table>';
    }
?>