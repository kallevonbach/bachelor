<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pakhuset
 */

?>
	</div><!-- #content -->
	
	<div class="container nyhedsbrev">
		<div class="row-wrapper">
			<div class="col-12">
			<h2><?php echo cfs_get_option('options', 'overskrift_til_nyhedsbrev_signup');?></h2>
			</div>
		</div>
		<div class="row-wrapper lower-CTA">
			<div class="col-full-6 text-CTA">
				<p><?php echo cfs_get_option('options', 'nyhedbrev_signup_text'); ?></p>
			</div>
			
			<div class="col-5 input-CTA">
				<?php echo do_shortcode( ' 	[mc4wp_form id="145"] ' ); ?>
			</div>
		</div>
	
	</div>


	<footer id="footer" class="site-footer">
		<div class="container">
			<div class="row-wrapper">
				<div class="col-4">
					<h4><?php echo cfs_get_option('options', 'footer_overskrift_1');?></h4>
					<p><?php echo bloginfo('name'); ?><br>
						<?php echo cfs_get_option('options', 'adresse_footer');?><br>
						<?php echo cfs_get_option('options', 'postnr_og_by_footer');?><br><br>
						<i class="fa fa-phone" aria-hidden="true"></i>
						<a href="tel:<?php echo cfs_get_option('options', 'tlf_footer');?>"><?php echo cfs_get_option('options', 'tlf_footer');?></a>
					</p>

					<a href="<?php echo cfs_get_option('options', 'facebook');?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
				</div>
				<div class="col-4">
					<h4><?php echo cfs_get_option('options', 'footer_overskrift_2');?></h4>
					<?php
					wp_nav_menu( array(
						'menu'           => 'Footer', 
						'theme_location' => 'footer',
						'menu_class' => 'footer-menu'
						) );
					?>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
