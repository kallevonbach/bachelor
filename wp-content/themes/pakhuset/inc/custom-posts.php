<?php

function medlemmer() {

	$labels = array(
		'name'                  => _x( 'Medlemmer', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Medlem', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Medlemsliste', 'text_domain' ),
		'name_admin_bar'        => __( 'Medlemsliste', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Post Attributer', 'text_domain' ),
		'parent_item_colon'     => __( 'Forældre Post:', 'text_domain' ),
		'all_items'             => __( 'Alle Medlemmer', 'text_domain' ),
		'add_new_item'          => __( 'Tilføj Nyt Medlem', 'text_domain' ),
		'add_new'               => __( 'Tilføj Medlem', 'text_domain' ),
		'new_item'              => __( 'Ny Post', 'text_domain' ),
		'edit_item'             => __( 'Redigere Post', 'text_domain' ),
		'update_item'           => __( 'Opdatere Post', 'text_domain' ),
		'view_item'             => __( 'Se Post', 'text_domain' ),
		'view_items'            => __( 'Se Posts', 'text_domain' ),
		'search_items'          => __( 'Søg i medlemmer', 'text_domain' ),
		'not_found'             => __( 'Ikke Fundet', 'text_domain' ),
		'not_found_in_trash'    => __( 'Ikke fundet i skraldspand', 'text_domain' ),
		'featured_image'        => __( 'Udvalgte billede', 'text_domain' ),
		'set_featured_image'    => __( 'Sæt udvalgte billede', 'text_domain' ),
		'remove_featured_image' => __( 'Fjærn udvalgte billede', 'text_domain' ),
		'use_featured_image'    => __( 'Brug udvalgte billede', 'text_domain' ),
		'insert_into_item'      => __( 'Indsæt i post', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploadet til denne post', 'text_domain' ),
		'items_list'            => __( 'Post liste', 'text_domain' ),
		'items_list_navigation' => __( 'Post list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter post liste', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'medlemmer',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Medlemmer', 'text_domain' ),
		'description'           => __( 'Medlemmer posts', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions' ),
		'taxonomies'            => array( 'medlemmer_tax' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-id',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,

		'capability_type'       => 'page',
	);
	register_post_type( 'medlemmer', $args );

}
add_action( 'init', 'medlemmer');

// Register Custom Taxonomy
function medlemmer_tax() {

	$labels = array(
		'name'                       => _x( 'Medlemmer', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Medlem', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Medlemmer', 'text_domain' ),
		'all_items'                  => __( 'Alle Medlemmer', 'text_domain' ),
		'parent_item'                => __( 'Forældre Medlem', 'text_domain' ),
		'parent_item_colon'          => __( 'Forældre Medlem:', 'text_domain' ),
		'new_item_name'              => __( 'Nyt Medlem', 'text_domain' ),
		'add_new_item'               => __( 'Tilføj nyt Medlem', 'text_domain' ),
		'edit_item'                  => __( 'Rediger medlem', 'text_domain' ),
		'update_item'                => __( 'opdater medlem', 'text_domain' ),
		'view_item'                  => __( 'Se medlem', 'text_domain' ),
		'separate_items_with_commas' => __( 'Adskil medlemmer med komma', 'text_domain' ),
		'add_or_remove_items'        => __( 'Tilføj eller fjern medlem', 'text_domain' ),
		'choose_from_most_used'      => __( 'Vælg blandt de mest brugte', 'text_domain' ),
		'popular_items'              => __( 'Populære medlemmer', 'text_domain' ),
		'search_items'               => __( 'Søg medlem', 'text_domain' ),
		'not_found'                  => __( 'Ikke fundet', 'text_domain' ),
		'no_terms'                   => __( 'Ingen medlemmer fundet', 'text_domain' ),
		'items_list'                 => __( 'Medlems list', 'text_domain' ),
		'items_list_navigation'      => __( 'Medlem list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,

	);
	register_taxonomy( 'medlemmer_tax', array( 'medlemmer' ), $args );

}
add_action( 'init', 'medlemmer_tax');

function udstillinger() {
	
		$labels = array(
			'name'                  => _x( 'Udstillinger', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Udstilling', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Udstillinger', 'text_domain' ),
			'name_admin_bar'        => __( 'Udstillinger', 'text_domain' ),
			'archives'              => __( 'Item Archives', 'text_domain' ),
			'attributes'            => __( 'Post Attributer', 'text_domain' ),
			'parent_item_colon'     => __( 'Forældre Post:', 'text_domain' ),
			'all_items'             => __( 'Alle Posts', 'text_domain' ),
			'add_new_item'          => __( 'Tilføj Ny Post', 'text_domain' ),
			'add_new'               => __( 'Tilføj Ny', 'text_domain' ),
			'new_item'              => __( 'Ny Post', 'text_domain' ),
			'edit_item'             => __( 'Redigere Post', 'text_domain' ),
			'update_item'           => __( 'Opdatere Post', 'text_domain' ),
			'view_item'             => __( 'Se Post', 'text_domain' ),
			'view_items'            => __( 'Se Posts', 'text_domain' ),
			'search_items'          => __( 'Søg Posts', 'text_domain' ),
			'not_found'             => __( 'Ikke Fundet', 'text_domain' ),
			'not_found_in_trash'    => __( 'Ikke fundet i skraldspand', 'text_domain' ),
			'featured_image'        => __( 'Udvalgte billede', 'text_domain' ),
			'set_featured_image'    => __( 'Sæt udvalgte billede', 'text_domain' ),
			'remove_featured_image' => __( 'Fjærn udvalgte billede', 'text_domain' ),
			'use_featured_image'    => __( 'Brug udvalgte billede', 'text_domain' ),
			'insert_into_item'      => __( 'Indsæt i post', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploadet til denne post', 'text_domain' ),
			'items_list'            => __( 'Post liste', 'text_domain' ),
			'items_list_navigation' => __( 'Post list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter post liste', 'text_domain' ),
		);
		$rewrite = array(
			'slug'                  => 'udstillinger',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);
		$args = array(
			'label'                 => __( 'Udstillinger', 'text_domain' ),
			'description'           => __( 'Udstillinger posts', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'page-attributes', 'post-formats', ),
			'taxonomies'            => array( 'udstillinger_tax' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-format-gallery',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
	
			'capability_type'       => 'page',
		);
		register_post_type( 'udstillinger', $args );
	
	}
	add_action( 'init', 'udstillinger', 0 );
	
	// Register Custom Taxonomy
	function udstillinger_tax() {
	
		$labels = array(
			'name'                       => _x( 'Udstillinger Katagorier', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Udstilling', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Katagorier', 'text_domain' ),
			'all_items'                  => __( 'Alle Udstillinger', 'text_domain' ),
			'parent_item'                => __( 'Forældre Udstillinge', 'text_domain' ),
			'parent_item_colon'          => __( 'Forældre Udstilling:', 'text_domain' ),
			'new_item_name'              => __( 'Ny Udstilling', 'text_domain' ),
			'add_new_item'               => __( 'Tilføj ny udstilling', 'text_domain' ),
			'edit_item'                  => __( 'Redigere udstilling', 'text_domain' ),
			'update_item'                => __( 'opdatere udstilling', 'text_domain' ),
			'view_item'                  => __( 'Se udstilling', 'text_domain' ),
			'separate_items_with_commas' => __( 'Adskille udstillinger med kommaer', 'text_domain' ),
			'add_or_remove_items'        => __( 'Tilføj eller fjern udstilling', 'text_domain' ),
			'choose_from_most_used'      => __( 'Vælg blandt de mest brugte', 'text_domain' ),
			'popular_items'              => __( 'Populære udstillinger', 'text_domain' ),
			'search_items'               => __( 'Søg udstilling', 'text_domain' ),
			'not_found'                  => __( 'Ikke fundet', 'text_domain' ),
			'no_terms'                   => __( 'Ingen udstilling', 'text_domain' ),
			'items_list'                 => __( 'Udstillings list', 'text_domain' ),
			'items_list_navigation'      => __( 'Udstillinger list navigation', 'text_domain' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
	
		);
		register_taxonomy( 'udstillinger_tax', array( 'udstillinger' ), $args );
	
	}
	add_action( 'init', 'udstillinger_tax', 0 );