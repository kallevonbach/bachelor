<div class="login-form-container container">
	<h3>Login oplysninger findes på forsiden af rapporten</h3>
    <p><strong>Brugernavn: </strong>Fornavnet på personen der står sidst i boksen med navne og CPR-numre</></p>
    <p><strong>Adgangskode: </strong>Cpr-nummeret på den person der står først i den samme boks (inklusiv bindestreg, uden mellemrum)</p>
    <?php if ( $attributes['show_title'] ) : ?>
        <h2><?php _e( 'Sign In', 'grupper-login' ); ?></h2>
    <?php endif; ?>
    <!-- Show errors if there are any -->
    <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
        <?php foreach ( $attributes['errors'] as $error ) : ?>
            <p class="login-error">
                <?php echo $error; ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ( $attributes['password_updated'] ) : ?>
    <p class="login-info">
        <?php _e( 'Your password has been changed. You can sign in now.', 'personalize-login' ); ?>
    </p>
<?php endif; ?>
    <?php if ( $attributes['registered'] ) : ?>
    <p class="login-info">
        <?php
            printf(
                __( 'You have successfully registered to <strong>%s</strong>. We have emailed your password to the email address you entered.', 'grupper-login' ),
                get_bloginfo( 'name' )
            );
        ?>
    </p>
    <?php endif; ?>
    <!-- Show logged out message if user just logged out -->
    <?php 
	// Check if user just logged out
	$attributes['logged_out'] = isset( $_REQUEST['logged_out'] ) && $_REQUEST['logged_out'] == true;    
    if ( $attributes['logged_out'] ) : ?>
        <p class="login-info">
            <?php _e( 'Du blev logget ud.', 'grupper-login' ); ?>
        </p>
    <?php endif; ?>
    <?php
        wp_login_form(
            array(
                'label_username' => __( 'Email', 'grupper-login' ),
                'label_log_in' => __( 'Sign In', 'grupper-login' ),
                'redirect' => $attributes['redirect'],
            )
        );
    ?>
    <a href="member-register"> Opret Bruger </a><br>
    
    <a class="forgot-password" href="<?php echo wp_lostpassword_url(); ?>">
        <?php _e( 'har du glemt dit kodeord?', 'grupper-login' ); ?>
    </a>
</div>