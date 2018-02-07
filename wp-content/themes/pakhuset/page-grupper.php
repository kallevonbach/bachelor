<?php
/**
 * Grupper Taxonomy template
 */

get_header(); ?>



<?php// require_once ABSPATH . '/wp-content/plugins/grupper/includes/inc/user.php'; ?>


	<div id="main" class="container padding">
		<!-- <div class="row-wrapper">
		
		<?php // $userobjekt = new User(); ?>
		
		<?php// $userobjekt->setUserId(); ?>
		<?php // $userobjekt->setUserName(); ?>
		<?php // $userobjekt->setUser(); ?>
		
		<br><br><br><br><p> asdf </p><br><br><br><br>
		<div style="max-width: 20%;">	
		<?php // echo($userobjekt->userId->data->display_name); ?>
		</div>
		
					
		<br><br><br><br><p> ddddasddsfsaff </p><br><br><br><br>		
		<?php// print("<pre>".print_r($userobjekt,true)."</pre>"); ?>
			
		<?php // add_user_meta( 2, 'gruppe adgang', 'yes') ?>
		
		<?php //print("<pre>".print_r(wp_get_current_user(),true)."</pre>"); ?>
		<?php // print("<pre>".print_r(get_user_meta(2),true)."</pre>"); ?>
		


		 -->
		
		
		
		
		
		
		
		
		
		<?php/*
		// the query
		$tax = 'grupper_tax';
		$terms = get_terms( $tax, [
			'hide_empty' => false
		]);
		$args = array(
			'post_type' => 'grupper_post',
			'tax_query' => array(
				array(
					'taxonomy' => 'grupper_tax')));
		$the_query = new WP_Query( $args );
		?>
		<?php
		foreach( $terms as $term ) { ?>
			<div class="col-4">
				<a class="u-href" href="<?php echo get_term_link($term); ?>">
					<div class="img-wrapper">
						<p class="u-date"><?php echo $term->name; ?></p>
						<div class="overlay">
							<div class="img-con-t" style="background-image: url('<?php echo get_field('grupper_featured_image', $term); ?>')"></div>
						</div>
						<div class="img-con-u" style="background-image: url('<?php echo get_field('grupper_featured_image', $term); ?>')"></div>
					</div>
					<h5><?php echo $term->name; ?></h5>
					<p><?php echo $term->description; ?></p>
				</a>
			</div>
			<?php
		};
		*/?>
		</div>
	</div><!-- #main -->

<?php get_footer();