<?php
/**
* Auction class - defines the Auction object.
*/
class User_login {

	public function __construct() {
		add_shortcode( 'member-login-form', array( $this, 'render_login_form' ) );

		add_action( 'login_form_login', array( $this, 'redirect_to_groups' ) );

		add_action( 'wp_logout', array( $this, 'redirect_after_logout' ) );

		add_action( 'wp_logout', array( $this, 'redirect_after_logout' ) );
		
		add_filter( 'authenticate', array( $this, 'redirect_at_authenticate' ), 100, 3 );
	
		add_filter( 'login_redirect', array( $this, 'redirect_after_login' ), 10, 3 );

		add_shortcode( 'member-register-form', array( $this, 'render_register_form' ) );

		add_action( 'login_form_register', array( $this, 'redirect_to_custom_register' ) );

		add_action( 'login_form_register', array( $this, 'do_register_user' ) );

		add_filter( 'admin_init' , array( $this, 'register_settings_fields' ) );

		add_action( 'wp_print_footer_scripts', array( $this, 'add_captcha_js_to_footer' ) );
		
		add_action( 'login_form_lostpassword', array( $this, 'redirect_to_custom_lostpassword' ) );
		
		add_shortcode( 'custom-password-lost-form', array( $this, 'render_password_lost_form' ) );
		
		add_action( 'login_form_lostpassword', array( $this, 'do_password_lost' ) );
		
		add_action( 'login_form_rp', array( $this, 'redirect_to_custom_password_reset' ) );
		
		add_action( 'login_form_resetpass', array( $this, 'redirect_to_custom_password_reset' ) );
		
		add_shortcode( 'custom-password-reset-form', array( $this, 'render_password_reset_form' ) );
		
		add_action( 'login_form_rp', array( $this, 'do_password_reset' ) );
		
		add_action( 'login_form_resetpass', array( $this, 'do_password_reset' ) );


	}	
	
		 /**
		 * Resets the user's password if the password reset form was submitted.
		 */
		public function do_password_reset() {
		    if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
		        $rp_key = $_REQUEST['rp_key'];
		        $rp_login = $_REQUEST['rp_login'];
		 
		        $user = check_password_reset_key( $rp_key, $rp_login );
		 
		        if ( ! $user || is_wp_error( $user ) ) {
		            if ( $user && $user->get_error_code() === 'expired_key' ) {
		                wp_redirect( home_url( 'member-login?login=expiredkey' ) );
		            } else {
		                wp_redirect( home_url( 'member-login?login=invalidkey' ) );
		            }
		            exit;
		        }
		 
		        if ( isset( $_POST['pass1'] ) ) {
		            if ( $_POST['pass1'] != $_POST['pass2'] ) {
		                // Passwords don't match
		                $redirect_url = home_url( 'member-password-reset' );
		 
		                $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
		                $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
		                $redirect_url = add_query_arg( 'error', 'password_reset_mismatch', $redirect_url );
		 
		                wp_redirect( $redirect_url );
		                exit;
		            }
		 
		            if ( empty( $_POST['pass1'] ) ) {
		                // Password is empty
		                $redirect_url = home_url( 'member-password-reset' );
		 
		                $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
		                $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
		                $redirect_url = add_query_arg( 'error', 'password_reset_empty', $redirect_url );
		 
		                wp_redirect( $redirect_url );
		                exit;
		            }
		 
		            // Parameter checks OK, reset password
		            reset_password( $user, $_POST['pass1'] );
		            wp_redirect( home_url( 'member-login?password=changed' ) );
		        } else {
		            echo "Invalid request.";
		        }
		 
		        exit;
		    }
		}
	
		 /**
		 * A shortcode for rendering the form used to reset a user's password.
		 *
		 * @param  array   $attributes  Shortcode attributes.
		 * @param  string  $content     The text content for shortcode. Not used.
		 *
		 * @return string  The shortcode output
		 */
		public function render_password_reset_form( $attributes, $content = null ) {
		    // Parse shortcode attributes
		    $default_attributes = array( 'show_title' => false );
		    $attributes = shortcode_atts( $default_attributes, $attributes );
		 
		    if ( is_user_logged_in() ) {
		        return __( 'You are already signed in.', 'grupper-login' );
		    } else {
		        if ( isset( $_REQUEST['login'] ) && isset( $_REQUEST['key'] ) ) {
		            $attributes['login'] = $_REQUEST['login'];
		            $attributes['key'] = $_REQUEST['key'];
		 
		            // Error messages
		            $errors = array();
		            if ( isset( $_REQUEST['error'] ) ) {
		                $error_codes = explode( ',', $_REQUEST['error'] );
		 
		                foreach ( $error_codes as $code ) {
		                    $errors []= $this->get_error_message( $code );
		                }
		            }
		            $attributes['errors'] = $errors;
		 
		            return $this->get_template_html( 'password_reset_form', $attributes );
		        } else {
		            return __( 'Invalid password reset link.', 'grupper-login' );
		        }
		    }
		}
	
	
	 /**
	 * Redirects to the custom password reset page, or the login page
	 * if there are errors.
	 */
	public function redirect_to_custom_password_reset() {
	    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
	        // Verify key / login combo
	        $user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );
	        if ( ! $user || is_wp_error( $user ) ) {
	            if ( $user && $user->get_error_code() === 'expired_key' ) {
	                wp_redirect( home_url( 'member-login?login=expiredkey' ) );
	            } else {
	                wp_redirect( home_url( 'member-login?login=invalidkey' ) );
	            }
	            exit;
	        }
	 
	        $redirect_url = home_url( 'member-password-reset' );
	        $redirect_url = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirect_url );
	        $redirect_url = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirect_url );
	 
	        wp_redirect( $redirect_url );
	        exit;
	    }
	}
	
	
	/**
	 * Redirect til "Forgot your password?" istedet for
	 * wp-login.php?action=lostpassword.
	 */
	public function redirect_to_custom_lostpassword() {
	    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
	        if ( is_user_logged_in() ) {
	            $this->redirect_logged_in_user();
	            exit;
	        }
	 
	        wp_redirect( home_url( 'member-password-lost' ) );
	        exit;
	    }
	}
	
	 /**
	 * Initiates password reset.
	 */
	public function do_password_lost() {
	    if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
	        $errors = retrieve_password();
	        if ( is_wp_error( $errors ) ) {
	            // Errors found
	            $redirect_url = home_url( 'member-password-lost' );
	            $redirect_url = add_query_arg( 'errors', join( ',', $errors->get_error_codes() ), $redirect_url );
	        } else {
	            // Email sent
	            $redirect_url = home_url( 'member-login' );
	            $redirect_url = add_query_arg( 'checkemail', 'confirm', $redirect_url );
	        }
	 
	        wp_redirect( $redirect_url );
	        exit;
	    }
	}
	
	/**
	 * A shortcode for rendering the form used to initiate the password reset.
	 *
	 * @param  array   $attributes  Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_password_lost_form( $attributes, $content = null ) {
	    // Parse shortcode attributes
	    $default_attributes = array( 'show_title' => false );
	    $attributes = shortcode_atts( $default_attributes, $attributes );
	 
	    if ( is_user_logged_in() ) {
	        return __( 'You are already signed in.', 'grupper-login' );
	    } else {
		    // Retrieve possible errors from request parameters
$attributes['errors'] = array();
if ( isset( $_REQUEST['errors'] ) ) {
    $error_codes = explode( ',', $_REQUEST['errors'] );
 
    foreach ( $error_codes as $error_code ) {
        $attributes['errors'] []= $this->get_error_message( $error_code );
    }
}
	        return $this->get_template_html( 'password_lost_form', $attributes );
	    }
	}
	
	
	/**
	 * Gets HTML template for login
	 */
	private function get_template_html( $template_name, $attributes = null ) {
		if ( ! $attributes ) {
			$attributes = array();
		}
	 
		ob_start();
	 
		do_action( 'grupper_login_before_' . $template_name );
	 
		require( 'templates/' . $template_name . '.php');
	 
		do_action( 'grupper_login_after_' . $template_name );
	 
		$html = ob_get_contents();
		ob_end_clean();
	 
		return $html;
	}

	// Get login-form 
	public function render_login_form( $attributes, $content = null ) {
		// Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
		$show_title = $attributes['show_title'];
	 
		if ( is_user_logged_in() ) {
			return __( 'Du er allerede logget ind.', 'grupper-login' );
		}
		 
		// Pass the redirect parameter to the WordPress login functionality: by default,
		// don't specify a redirect, but if a valid redirect URL has been passed as
		// request parameter, use it.
		$attributes['redirect'] = '';
		if ( isset( $_REQUEST['redirect_to'] ) ) {
			$attributes['redirect'] = wp_validate_redirect( $_REQUEST['redirect_to'], $attributes['redirect'] );
		}
		// Error messages
		$errors = array();
		if ( isset( $_REQUEST['login'] ) ) {
			$error_codes = explode( ',', $_REQUEST['login'] );
		
			foreach ( $error_codes as $code ) {
				$errors []= $this->get_error_message( $code );
			}
		}
		$attributes['errors'] = $errors;
		// Check if the user just registered
		$attributes['registered'] = isset( $_REQUEST['registered'] );
		
		// Check if the user just requested a new password 
		$attributes['lost_password_sent'] = isset( $_REQUEST['checkemail'] ) && $_REQUEST['checkemail'] == 'confirm';
		// Check if user just updated password
		$attributes['password_updated'] = isset( $_REQUEST['password'] ) && $_REQUEST['password'] == 'changed';

		
		// Render the login form using an external template
		return $this->get_template_html( 'login-form', $attributes );
	}

	/**
	 * Redirect the user to the custom login page instead of wp-login.php.
	 */
	function redirect_to_groups() {
		if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
			$redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : null;
		
			if ( is_user_logged_in() ) {
				$this->redirect_logged_in_user( $redirect_to );
				exit;
			}
	
			// The rest are redirected to the login page
			$login_url = home_url( 'member-login' );
			if ( ! empty( $redirect_to ) ) {
				$login_url = add_query_arg( 'redirect_to', $redirect_to, $login_url );
			}
	
			wp_redirect( $login_url );
			exit;
		}
	}
	/**
	 * Redirects the user to the correct page depending on whether he / she
	 * is an admin or not.
	 */
	private function redirect_logged_in_user( $redirect_to = null ) {
		$user = wp_get_current_user();
		if ( user_can( $user, 'manage_options' ) ) {
			if ( $redirect_to ) {
				wp_safe_redirect( $redirect_to );
			} else {
				wp_redirect( admin_url() );
			}
		} else {
			wp_redirect( home_url( 'grupper-oversigt' ) );
		}
	}

	function redirect_at_authenticate( $user, $username, $password ) {
		// Check if the earlier authenticate filter (most likely, 
		// the default WordPress authentication) functions have found errors
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
			if ( is_wp_error( $user ) ) {
				$error_codes = join( ',', $user->get_error_codes() );
	 
				$login_url = home_url( 'member-login' );
				$login_url = add_query_arg( 'login', $error_codes, $login_url );
	 
				wp_redirect( $login_url );
				exit;
			}
		}
	 
		return $user;
	}
	private function get_error_message( $error_code ) {
		switch ( $error_code ) {
			case 'expiredkey':
			case 'invalidkey':
			    return __( 'The password reset link you used is not valid anymore.', 'grupper-login' );
			 
			case 'password_reset_mismatch':
			    return __( "The two passwords you entered don't match.", 'grupper-login' );
			     
			case 'password_reset_empty':
			    return __( "Sorry, we don't accept empty passwords.", 'grupper-login' );
			
			case 'empty_username':
			    return __( 'You need to enter your email address to continue.', 'grupper-login' );
			 
			case 'invalid_email':
			case 'invalidcombo':
			    return __( 'There are no users registered with this email address.', 'grupper-login' );
			case 'empty_username':
				return __( 'Indtast venligst din email', 'grupper-login' );
	 
			case 'empty_password':
				return __( 'Indtast kodeord for at logge ind.', 'grupper-login' );
	 
			case 'invalid_username':
				return __("Der blev ikke fundet nogen bruger, der matchede den angivne email", 'grupper-login');
	 
			case 'incorrect_password':
				$err = __(
					"Det angivne kodeord var ikke korrekt. <a href='%s'>Har du glemt dit kodeord?</a>?",
					'grupper-login'
				);
				return sprintf( $err, wp_lostpassword_url() );
			case 'captcha':
				return __( 'Du skal afkrydse reCAPTCHA feltet før du kan blive registreret', 'grupper-login' );	
			default:
				break;
		}
		 
		return __( 'En ukendt fejl opstod, prøv venligst igen senere', 'grupper-login' );
	}

	
	/**
	 * Redirect to custom login page after the user has been logged out.
	 */
	public function redirect_after_logout() {
		$redirect_url = home_url( 'member-login?logged_out=true' );
		wp_safe_redirect( $redirect_url );
		exit;
	}


	/**
	 * Returns the URL to which the user should be redirected after the (successful) login.
	 */
	public function redirect_after_login( $redirect_to, $requested_redirect_to, $user ) {
		$redirect_url = home_url();
	
		if ( ! isset( $user->ID ) ) {
			return $redirect_url;
		}
	
		if ( user_can( $user, 'manage_options' ) ) {
			// Use the redirect_to parameter if one is set, otherwise redirect to admin dashboard.
			if ( $requested_redirect_to == '' ) {
				$redirect_url = admin_url();
			} else {
				$redirect_url = $requested_redirect_to;
			}
		} else {
			// Non-admin users always go to their account page after login
			$redirect_url = home_url( 'grupper-oversigt' );
		}
	
		return wp_validate_redirect( $redirect_url, home_url() );
	}

	/**
	 * A shortcode for rendering the new user registration form.
	 */
	public function render_register_form( $attributes, $content = null ) {
		// Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
	
		if ( is_user_logged_in() ) {
			return __( 'Du er allerede logget ind.', 'grupper-login' );
		} elseif ( ! get_option( 'users_can_register' ) ) {
			return __( 'Det er desværre ikke muligt at registrere nye brugere lige nu.', 'grupper-login' );
		} else {
			return $this->get_template_html( 'register_form', $attributes );
		}
		// Retrieve possible errors from request parameters
		$attributes['errors'] = array();
		if ( isset( $_REQUEST['register-errors'] ) ) {
			$error_codes = explode( ',', $_REQUEST['register-errors'] );
		
			foreach ( $error_codes as $error_code ) {
				$attributes['errors'] []= $this->get_error_message( $error_code );
			}
		}
		// Retrieve recaptcha key
		$attributes['recaptcha_site_key'] = get_option( 'grupper-login-recaptcha-site-key', null );
	}

	/**
	 * Redirects the user to the custom registration page instead
	 * of wp-login.php?action=register.
	 */
	public function redirect_to_custom_register() {
		if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
			if ( is_user_logged_in() ) {
				$this->redirect_logged_in_user();
			} else {
				wp_redirect( home_url( 'member-register' ) );
			}
			exit;
		}
	}

	/**
	 * Validates and then completes the new user signup process if all went well.
	 * returns the id of the user that was created, or error if failed.
	 */
	private function register_user( $email, $first_name, $last_name ) {
	    $errors = new WP_Error();
	 
	    // Email address is used as both username and email. It is also the only
	    // parameter we need to validate
	    if ( ! is_email( $email ) ) {
	        $errors->add( 'email', $this->get_error_message( 'email' ) );
	        return $errors;
	    }
	 
	    if ( username_exists( $email ) || email_exists( $email ) ) {
	        $errors->add( 'email_exists', $this->get_error_message( 'email_exists') );
	        return $errors;
	    }
	 
	    // Generate the password so that the subscriber will have to check email...
	    $password = wp_generate_password( 12, true );
	 
	    $user_data = array(
	        'user_login'    => $email,
	        'user_email'    => $email,
	        'user_pass'     => $password,
	        'first_name'    => $first_name,
	        'last_name'     => $last_name,
	        'nickname'      => $first_name,
	    );
	 
	    $user_id = wp_insert_user( $user_data );
	    wp_new_user_notification( $user_id, $password );
	 
	    return $user_id;
	}	
	/**
	 * Handles the registration of a new user.
	 *
	 * Used through the action hook "login_form_register"
	 * when accessed through the registration action.
	 */
	public function do_register_user() {
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
			$redirect_url = home_url( 'member-register' );
	
			if ( ! get_option( 'users_can_register' ) ) {
				// Registration closed, display error
				$redirect_url = add_query_arg( 'register-errors', 'closed', $redirect_url );
			} elseif ( ! $this->verify_recaptcha() ) {
				// Recaptcha check failed, display error
				$redirect_url = add_query_arg( 'register-errors', 'captcha', $redirect_url );
			} else {
				$email = $_POST['email'];
				$first_name = sanitize_text_field( $_POST['first_name'] );
				$last_name = sanitize_text_field( $_POST['last_name'] );
				
				$result = $this->register_user( $email, $first_name, $last_name );
				
			 
				if ( is_wp_error( $result ) ) {
					// Parse errors into a string and append as parameter to redirect
					$errors = join( ',', $result->get_error_codes() );
					$redirect_url = add_query_arg( 'register-errors', $errors, $redirect_url );
				} else {
					$group_memberships = array();
					update_user_meta( $result, 'Gruppe_medlemskaber', $group_memberships);
					// Success, redirect to login page.
					$redirect_url = home_url( 'member-login' );
					$redirect_url = add_query_arg( 'registered', $email, $redirect_url );
				}
			}
			wp_redirect( $redirect_url );
			exit;
		}
	}

	/**
	 * Registers the settings fields needed by the plugin.
	 */
	public function register_settings_fields() {
		// Create settings fields for the two keys used by reCAPTCHA
		register_setting( 'general', 'grupper-login-recaptcha-site-key' );
		register_setting( 'general', 'grupper-login-recaptcha-secret-key' );
	
		add_settings_field(
			'grupper-login-recaptcha-site-key',
			'<label for="grupper-login-recaptcha-site-key">' . __( 'reCAPTCHA site key' , 'grupper-login' ) . '</label>',
			array( $this, 'render_recaptcha_site_key_field' ),
			'general'
		);
	
		add_settings_field(
			'grupper-login-recaptcha-secret-key',
			'<label for="grupper-login-recaptcha-secret-key">' . __( 'reCAPTCHA secret key' , 'grupper-login' ) . '</label>',
			array( $this, 'render_recaptcha_secret_key_field' ),
			'general'
		);
	}
	
	public function render_recaptcha_site_key_field() {
		$value = get_option( 'grupper-login-recaptcha-site-key', '' );
		echo '<input type="text" id="grupper-login-recaptcha-site-key" name="grupper-login-recaptcha-site-key" value="' . esc_attr( $value ) . '" />';
	}
	
	public function render_recaptcha_secret_key_field() {
		$value = get_option( 'grupper-login-recaptcha-secret-key', '' );
		echo '<input type="text" id="grupper-login-recaptcha-secret-key" name="grupper-login-recaptcha-secret-key" value="' . esc_attr( $value ) . '" />';
	}

	/**
	 * An action function used to include the reCAPTCHA JavaScript file
	 * at the end of the page.
	 */
	public function add_captcha_js_to_footer() {
		echo "<script src='https://www.google.com/recaptcha/api.js'></script>";
	}

	/**
	 * Checks that the RECAPTCHA parameter sent with the registration
	 * request is valid.
	 * returns a True boolean, if the CAPTCHA is OK, otherwise false.
	 */
	private function verify_recaptcha() {
		// This field is set by the recaptcha widget if check is successful
		if ( isset ( $_POST['g-recaptcha-response'] ) ) {
			$captcha_response = $_POST['g-recaptcha-response'];
		} else {
			return false;
		}
	
		// Verify the captcha response from Google
		$response = wp_remote_post(
			'https://www.google.com/recaptcha/api/siteverify',
			array(
				'body' => array(
					'secret' => get_option( 'grupper-login-recaptcha-secret-key' ),
					'response' => $captcha_response
				)
			)
		);
	
		$success = false;
		if ( $response && is_array( $response ) ) {
			$decoded_response = json_decode( $response['body'] );
			$success = $decoded_response->success;
		}
	
		return $success;
	}
}
$userLogin = new User_login();
?>