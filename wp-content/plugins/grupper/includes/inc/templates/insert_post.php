<?php
if ( ! defined( 'ABSPATH' ) ) {
        exit; 
}
    $postTitleError = '';
    $secure_groupid = (int)$_GET['groupid'];
    if ($secure_groupid) { 
    if ( isset( $_POST['submitted'] ) ) {
        if ( trim( $_POST['postTitle'] ) === '' ) {
            $postTitleError = 'Skriv venligst en titel';
            $hasError = true;
        }
    }
    $post_information = array(
        'post_title' => wp_strip_all_tags( $_POST['postTitle'] ),
        'post_content' => $_POST['postContent'],
        'post_type' => 'grupper_post',
        'post_status' => 'publish',
        'comment_status' => 'open'
    );
    $success = false;
    $post_id = wp_insert_post( $post_information );
    if ( $post_id ) {
        wp_set_object_terms( $post_id, array('term_id' => $secure_groupid, 'term_taxonomy_id' => $secure_groupid), 'grupper_tax' );
        $success = true;
    }
    ?>
<div class="container">
<?php
    if($success) {
        echo '<h4 class="post-success-nr">Indlægget er nu oprettet</h4>';
    }
?>

    <form action="" id="primaryPostForm" method="POST">
    
        <fieldset>
            <label  for="postTitle"><?php _e('Post Title:', 'framework') ?></label>
    
            <input value="" type="text" name="postTitle" id="postTitle" class="required" />
        </fieldset>
    
        <fieldset>
            <label for="postContent"><?php _e('Post Content:', 'framework') ?></label>
    
            <textarea <?php if ( isset( $_POST['postContent'] ) ) { if ( function_exists( 'stripslashes' ) ) { echo stripslashes( $_POST['postContent'] ); } else { echo $_POST['postContent']; } } ?> name="postContent" id="postContent" rows="8" cols="30" class="required"></textarea>
        </fieldset>
        <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
        <fieldset>
            <input type="hidden" name="submitted" id="submitted" value="true" />
            
            <button type="submit"><?php _e('Add Post', 'framework') ?></button>
        </fieldset>
    
    </form>
</div>
<?php if ( $postTitleError != '' ) { ?>
    <span class="error"><?php echo $postTitleError; ?></span>
    <div class="clearfix"></div>
<?php }} else { echo 'nope'; } 


?>