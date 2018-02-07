<?php
class Group {
	public function __construct() {
        
        add_shortcode('gruppe-oversigt', array($this, 'show_groups'));

        add_shortcode('emne-oversigt', array($this, 'show_topics'));
        
        add_shortcode('post-oversigt', array($this, 'post_in_topic'));
        
        add_shortcode('applied', array($this, 'applied'));
        
		add_shortcode('insert_post', array($this, 'insert_post'));
		
        
    }
    public static function users_can_apply() {
		add_option( 'groups_requests', array() );	    	    
    }
    
    
    public function show_groups($attributes, $content = NULL) {
        $attributes = get_terms( array(
            'taxonomy' => 'grupper_tax',
            'hide_empty' => false,
            'parent' => 0
        ) );
        return $this->get_template_html( 'show-groups', $attributes );
    }
    
    public function show_topics($attributes, $content = NULL) {
        $secure_groupid = (int)$_GET['groupid'];
        $currentuserid = get_current_user_id();
		$usermeta = get_user_meta($currentuserid);
		$usermetagrupper = $usermeta['Gruppe_medlemskaber'];
		$unserializeddata = unserialize($usermetagrupper[0]);
     if(is_array($unserializeddata)){
            if (in_array($secure_groupid, $unserializeddata)) {
                $attributes = get_terms( array(
                    'taxonomy' => 'grupper_tax',
                    'hide_empty' => false,
                    'parent' => $secure_groupid
                    ) );
                    
            } else {
                $attributes = $secure_groupid;
                }
            }else {
                $attributes = $secure_groupid;
        }      

        return $this->get_template_html( 'show-topics', $attributes );
    }
    
    public function post_in_topic($secure_groupid) {
        
    return $this->get_template_html( 'post-in-topic' );
    }
    
    public function applied($response) {
	
        $secure_groupid = $_GET['applyforgroup'];
        $string_grupid = (string)$secure_groupid;        
        $groupname = get_term( $secure_groupid, 'grupper_tax');	
        $userid = get_current_user_id();
        $thecurrentarray = get_option('groups_requests');
        $currentgroupusers = $thecurrentarray[$string_grupid];
        $searchforuser = in_array($userid, $currentgroupusers); 
        
        if ($searchforuser) {
            $response =  'Du har allerede ansøgt til denne gruppe, vent venligst på godkendelse af administrator';
            return $response;
        } else {
            if(is_array($currentgroupusers) == false ) {
                $thecurrentarray[$string_grupid] = array();
            }
            array_push($thecurrentarray[$string_grupid], $userid);
            update_option( 'groups_requests', $thecurrentarray );   
            $response = 'Du har nu ansøgt om medlemskab til ' . $groupname->name . '<br>'; 
            return $response;
        }
	    return $this->get_template_html( 'applied', $response );
    }
    
    public function insert_post() {
	  
	    return $this->get_template_html( 'insert_post' );
    }
    
    
    
	 /**
	 * Henter html templates
	 *
	 * @param string $template_name 	Navnet på templaten
	 * @param array  $attributes    	Variablerne til templaten
	 *
	 * @return string               	Indholdet fra templaten
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
        
}
$group = new Group();
	