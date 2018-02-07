<?php
/* Template Name: Forside */

get_header(); ?>
<div class="slider">
	<div class="slide_viewer">
		<div class="slide_group">	
		<?php $fields = CFS()->get( 'slider' );
		foreach ( $fields as $field ) : ?>
			<div class="slide" style="background-image: url(<?php echo $field['billede'];?>);"><div class="slider-cap"><h1>
				<?php echo $field['tekst']; ?></h1></div></div>
		<?php endforeach; ?>
		</div>
		<div class="slide_buttons"><div class="frame"></div></div>
	</div>
</div>
<div class="container">
	<div class="row-wrapper">
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
	</div>
</div>

<?php 
$args = array('post_type' => 'udstillinger', 'posts_per_page' => 3);
$the_query = new WP_Query( $args );
	
	if ( $the_query->have_posts() ) : ?>
	
	<div class="udstillinger">
		<div class="container">
			<h2>Udstillinger</h2>
			<div class="row-wrapper">	
				<?php while ( $the_query->have_posts() ) : $the_query->the_post();
					$dateformatstring = "d/m/Y";
					$unixtime_start = strtotime(get_field('udstilling_start'));
					$unixtime_stop = strtotime(get_field('udstilling_stop'));

					$date_start = date_i18n($dateformatstring, $unixtime_start);
					$date_stop = date_i18n($dateformatstring, $unixtime_stop);
					$udtilling_img = get_the_post_thumbnail_url();
					$udtilling_title = get_the_title();
					$udtilling_content =  get_the_excerpt();
					$udtilling_link = get_permalink();
					?>

				<div class="col-4">
					<a class="u-href" href="<?php echo $udtilling_link; ?>">
						<div class="img-wrapper">
							<div class="text_wrap">
								<p class="u-date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $date_start . ' - ' . $date_stop; ?></p>
							</div>
							<div class="overlay">
								<div class="img-con-t" style="background-image: url('<?php echo $udtilling_img; ?>')"></div>
							</div>
							<div class="img-con-u" style="background-image: url('<?php echo $udtilling_img; ?>')"></div>
						</div>
						<h5><?php echo $udtilling_title; ?></h5>
						<p><?php echo $udtilling_content; ?></p>
					</a>
				</div>
			<?php endwhile; ?>
			</div>
		</div>
	</div>	
	<?php endif; ?>

	<div class="container articles">
		<?php 
		$args = array('post_type' => 'post', 'category_name' => 'news',  'posts_per_page' => 4);
			// The Query
		$the_query = new WP_Query( $args );
			
			// The Loop
			if ( $the_query->have_posts() ) {
				echo '<h2>Aktuelt</h2>';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					echo '<article class="row-wrapper">';
					echo '<div class="date col-2"><span>' . get_the_date('d') . '</span>' . get_the_date('M') .'</div>';
					echo '<div class="col-10 article-text"><a href="'.get_post_permalink().'"><h4>' . get_the_title().'</h4><p>' . get_the_excerpt() . '</p>';
					echo '</a></div></article>';
				}
			}
		?>
		</div>
	</div>
<?php

get_footer();
