<?php
/**
 * The template for displaying posts in grupper
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Pakhuset
 */

get_header(); ?>

<div class="container">
	<div id="primary" class="content-area container">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content-grupper', get_post_type() );
			
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div>

<?php
get_footer();