<?php
/**
 * Template part for displaying the udstillinger post type
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pakhuset
 */

?>

<article id="post-<?php the_ID(); ?>">
	
	<div class="row-wrapper single-udstilling">
		<div class="col-full-7">
			<div class="entry-content">
				<?php
					the_title( '<h1 class="entry-title">', '</h1>' );
				?>
					<div class="udstilling-date">
						<?php 
							$date_start = get_field('udstilling_start');
							$date_stop = get_field('udstilling_stop');
							$date_start = new DateTime($date_start);
							$date_stop = new DateTime($date_stop);
							echo $date_start->format('d/m/Y') . ' - ' .  $date_stop->format('d/m/Y'); 
						?>
					</div>
					<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pakhuset' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pakhuset' ),
						'after'  => '</div>',
					) );
				?>
			</div>
		</div>
		<div class="col-full-5">
			<img class="featured-img-udstilling" src="<?php echo get_the_post_thumbnail_url()?>" />
		</div>
	</div>
</article>
