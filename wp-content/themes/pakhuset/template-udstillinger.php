<?php
/* 
Template Name: Udstillinger 
Template Post Type: post, page, udstillinger
*/



get_header(); ?>
	<div id="main" class="udstillinger-page">
		<div class="container">
			<?php
				$args = array('post_type' => 'udstillinger');
				$the_query = new WP_Query( $args );

				$current_head = get_field('head_aktuelle');
				$upcoming_head = get_field('head_upcoming'); 
				$previous_head = get_field('head_previous'); 
				$no_post_current = get_field('no_posts_current');
				$no_post_previous = get_field('no_posts_previous');
				$no_post_upcoming = get_field('no_posts_upcoming');
				

			?>
			<h2><?php echo $current_head; ?></h2>	
			<div class="row-wrapper-left">
				<?php 
				while ( $the_query->have_posts() ) : $the_query->the_post();
					$date_start = get_field('udstilling_start');
					$date_stop = get_field('udstilling_stop');
					$date_start = new DateTime($date_start);
					$date_stop = new DateTime($date_stop);
					$date_now = date_create()->format('Y-m-d H:i:s');
					$post_link =  get_permalink();

					if($date_start->format('Y-m-d H:i:s') <= $date_now && $date_stop->format('Y-m-d H:i:s') >= $date_now) : ?>
						
						<div class="col-full-4">
							<a class="u-href" href="<?php echo $post_link; ?>">
								<div class="img-wrapper">
									<div class="text_wrap">
									<p class="u-date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $date_start->format('d/m/Y') . ' - ' .  $date_stop->format('d m Y'); ?></p>
									</div>
									<div class="overlay">
										<div class="img-con-t" style="background-image: url('<?php  echo get_the_post_thumbnail_url(); ?>')"></div>
									</div>
									<div class="img-con-u" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')"></div>
								</div>
								<h5><?php the_title(); ?></h5>
								<p><?php echo get_the_excerpt(); ?></p>
							</a>
						</div>
				<?php
				endif;
				endwhile; 
				echo '<p class="no-post">'.$no_post_current.'</p>';?>
				
			</div>
		</div>
		<div class="upcoming">
			<div class="container">
				<h2><?php echo $upcoming_head?></h2>	
				<div class="row-wrapper-left">
					<?php 
					while ( $the_query->have_posts() ) : $the_query->the_post();
					$date_start = get_field('udstilling_start');
					$date_stop = get_field('udstilling_stop');
					$date_start = new DateTime($date_start);
					$date_stop = new DateTime($date_stop);
					$date_now = date_create()->format('Y-m-d H:i:s');
					$post_link =  get_permalink();

					if($date_start->format('Y-m-d H:i:s') >= $date_now) : ?>
							
							<div class="col-full-4">
								<a class="u-href" href="<?php echo $post_link; ?>">
									<div class="img-wrapper">
										<div class="text_wrap">
										<p class="u-date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $date_start->format('d/m/Y') . ' - ' .  $date_stop->format('d/m/Y'); ?></p>
									</div>
									<div class="overlay">
										<div class="img-con-t" style="background-image: url('<?php  echo get_the_post_thumbnail_url(); ?>')"></div>
									</div>
									<div class="img-con-u" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')"></div>
								</div>
								<h5><?php the_title(); ?></h5>
								<p><?php echo get_the_excerpt(); ?></p>
								</a>
							</div>
						<?php endif;
						endwhile; 
						echo '<p class="no-post">'.$no_post_upcoming.'</p>';?>
					
				</div>
			</div>
		</div>
		<div class="container last-con">
			<h2>Tidligere udstilllinger</h2>
			<div class="row-wrapper-left">
			<?php 
						while ( $the_query->have_posts() ) : $the_query->the_post();
						$date_start = get_field('udstilling_start');
						$date_stop = get_field('udstilling_stop');
						$date_start = new DateTime($date_start);
						$date_stop = new DateTime($date_stop);
						$date_now = date_create()->format('Y-m-d H:i:s');
						$post_link =  get_permalink();

						if($date_stop->format('Y-m-d H:i:s') <= $date_now) : ?>
						
							<div class="col-full-4">
								<a class="u-href" href="<?php echo $post_link; ?>">
									<div class="img-wrapper">
										<div class="text_wrap">
										<p class="u-date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $date_start->format('d/m/Y') . ' - ' .  $date_stop->format('d/m/Y'); ?></p>
							</div>
							<div class="overlay">
								<div class="img-con-t" style="background-image: url('<?php  echo get_the_post_thumbnail_url(); ?>')"></div>
							</div>
							<div class="img-con-u" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')"></div>
							</div>
							<h5><?php the_title(); ?></h5>
							<p><?php echo get_the_excerpt(); ?></p>
							</a>
							</div>
				<?php endif;  
				endwhile; 
				echo '<p class="no-post">'. $no_post_upcoming.'</p>';?>
			</div>	
		</div>
	</div>

<?php
get_footer();
