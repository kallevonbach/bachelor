<?php
/**
 *  * Created by PhpStorm.
 * User: Ingibjörg Hilmarsdóttir
 * Date: 23.11.2017
 * Time: 14:10
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<div class="slick-slider">
			<?php for($i = 0; $i <= 10; $i++){
				if( get_field($i) ):
					echo'<img src="'. get_field($i). '" />';
				endif;
			}
			?>
			<img class="" src=" <?php echo get_field('slider_img'); ?> ">
		</div>
		<h1>HELLO</h1>
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
