<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pakhuset
 */

?>

<article id="post-<?php the_ID(); ?>" class="grupper-post">
	<div class="author-date">
		<div class="author-img" style="background-image: url('<?php echo get_avatar_url(get_the_author_meta('ID')); ?>')"></div>
		<p class="author-name"><?php echo get_the_author_meta('display_name'); ?></p>
		<p>Udgivet: <?php echo get_the_date() ?></p>
	</div>
	<div class="article-body">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); 
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
</article><!-- #post-<?php the_ID(); ?> -->
