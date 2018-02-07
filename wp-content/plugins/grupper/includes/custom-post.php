<?php 
// Register Custom Post Type
function grupper_post() {

	$labels = array(
		'name'                  => _x( 'Grupper', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Gruppe', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Grupper', 'text_domain' ),
		'name_admin_bar'        => __( 'Grupper', 'text_domain' ),
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
		'remove_featured_image' => __( 'Fjern udvalgte billede', 'text_domain' ),
		'use_featured_image'    => __( 'Brug udvalgte billede', 'text_domain' ),
		'insert_into_item'      => __( 'Indsæt i post', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploadet til denne post', 'text_domain' ),
		'items_list'            => __( 'Post liste', 'text_domain' ),
		'items_list_navigation' => __( 'Post list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter post liste', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'grupper',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Gruppe', 'text_domain' ),
		'description'           => __( 'Grupper posts', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'            => array( 'grupper_tax' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,

		'capability_type'       => 'page',
	);
	register_post_type( 'grupper_post', $args );

}
add_action( 'init', 'grupper_post', 0 );

// Register Custom Taxonomy
function grupper_tax() {

	$labels = array(
		'name'                       => _x( 'Grupper', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Gruppe', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Grupper', 'text_domain' ),
		'all_items'                  => __( 'Alle Grupper', 'text_domain' ),
		'parent_item'                => __( 'Forældre Gruppe', 'text_domain' ),
		'parent_item_colon'          => __( 'Forældre Gruppe:', 'text_domain' ),
		'new_item_name'              => __( 'Ny gruppe', 'text_domain' ),
		'add_new_item'               => __( 'Tilføj ny gruppe', 'text_domain' ),
		'edit_item'                  => __( 'Redigere gruppe', 'text_domain' ),
		'update_item'                => __( 'opdatere gruppe', 'text_domain' ),
		'view_item'                  => __( 'Se gruppe', 'text_domain' ),
		'separate_items_with_commas' => __( 'Adskille grupper med kommaer', 'text_domain' ),
		'add_or_remove_items'        => __( 'Tilføj eller fjern gruppe', 'text_domain' ),
		'choose_from_most_used'      => __( 'Vælg blandt de mest brugte', 'text_domain' ),
		'popular_items'              => __( 'Populære grupper', 'text_domain' ),
		'search_items'               => __( 'Søg grupper', 'text_domain' ),
		'not_found'                  => __( 'Ikke fundet', 'text_domain' ),
		'no_terms'                   => __( 'Ingen gruppe', 'text_domain' ),
		'items_list'                 => __( 'Gruppe list', 'text_domain' ),
		'items_list_navigation'      => __( 'Gruppe list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,

	);
	register_taxonomy( 'grupper_tax', array( 'grupper_post' ), $args );

}
add_action( 'init', 'grupper_tax', 0 );

 ?>