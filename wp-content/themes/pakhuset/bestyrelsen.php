<?php
/* Template Name: Bestyrelsen */

get_header(); ?>
<div class="container">
	<h1><?php echo get_the_title(); ?></h1>
		<section class="bestyrelsen">
			<div class="row-wrapper bestyrelsen-con">
			<?php $fields = CFS()->get( 'bestyrelsesmedlem' );
			foreach ( $fields as $field ) : ?>
				<div class="col-full-4 enkeltmedlem">
					<div class="top">
						<div class="img" style="background-image: url(<?php echo $field['billede'];?>)"></div> 
						<h4><?php echo $field['navn'];?></h4>
						<h5><?php echo $field['titel']; ?></h5>
					</div>
					<div class="bottom">
						<p><?php echo $field['adresse'];?></p>
						<p><a href="tel:+45<?php echo $field['tlf'];?>"><?php echo $field['tlf'];?></a></p>
						<p><a href="mailto:<?php echo $field['email'];?>"><?php echo $field['email'];?></a></p>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</section>
</div>
<?php

get_footer();
