<div id="register-form" class="widecolumn">
<?php if ( $attributes['show_title'] ) : ?>
    <h3><?php _e( 'Register', 'grupper-login' ); ?></h3>
<?php endif; ?>

<form id="signupform" action="<?php echo wp_registration_url(); ?>" method="post">
    <p class="form-row">
        <label for="email"><?php _e( 'Email', 'grupper-login' ); ?> <strong>*</strong></label>
        <input type="text" name="email" id="email">
    </p>

    <p class="form-row">
        <label for="first_name"><?php _e( 'Fornavn', 'grupper-login' ); ?></label>
        <input type="text" name="first_name" id="first-name">
    </p>

    <p class="form-row">
        <label for="last_name"><?php _e( 'Efternavn', 'grupper-login' ); ?></label>
        <input type="text" name="last_name" id="last-name">
    </p>
    <p class="form-row">
        <?php _e( 'Note: Dit kodeord vil blive genereret og sendt til din email. Kodeordet kan ændres under "Min konto"', 'grupper-login' ); ?>
    </p>
    <div class="recaptcha-container">
        <div class="g-recaptcha" data-sitekey="6LcZKD0UAAAAAHajW2oGkWKYL7y8CWknKEoMmbuP"></div>
    </div>
    <p class="signup-submit">
        <input type="submit" name="submit" class="register-button"
               value="<?php _e( 'Register', 'grupper-login' ); ?>"/>
    </p>
</form>
</div>