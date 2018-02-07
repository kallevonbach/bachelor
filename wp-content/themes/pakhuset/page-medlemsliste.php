<?php
/* Template Name: Medlemsliste */

get_header(); 
$placeholder = get_field('billede_placeholder'); ?>

	<div class="medlemmer-top container">
	<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
	</div>
	<section class="members container">
	<?php $field_key = 'field_5a293cfbcfb76';
			$field = get_field_object($field_key);
					if( $field )
					{
						echo '<select class="member-sort" name="' . $field['key'] . '">';
						echo '<option value="Alle">Alle</option>';
							foreach( $field['choices'] as $k => $v )
							{
								echo '<option value="' . $k . '">' . $v . '</option>';
							}
						echo '</select>';
					} 
			?>
		<div class="member-con">
			<div class="row-wrapper">
				<div class="col-full-4 member-overview">
					<ul class="member-list">
						<?php 
						$args = array( 'post_type' => 'medlemmer', 'posts_per_page' => -1,'orderby'=> 'title', 'order' => 'ASC' );
						$loop = new WP_Query( $args );
					
						while ( $loop->have_posts() ) : $loop->the_post();
						$cat = get_field('omrade_medlemmer');
						$splitCat = implode(" ", $cat);
						?>
						<li> <a class="post-link" data-cat="<?php echo $splitCat; ?>"  rel="<?php the_ID(); ?>"><?php the_title(); ?></a></li>
						<?php
						endwhile;
						?>
					</ul>
				</div>
				<div class="col-full-8 member-details">
						<div class="member-info-con">	
							<div class="img-con">
								<div class="member-pic" alt="Billede af medlem" ></div>
							</div>
							<h4 class="member-name"></h4>
							<h5 class="member-area"></h5>
							<p class="member-address"></p>
							<p class="member-zip"></p>
							<div class="member-text"></div>
						</div>
						<div class="member-contact-con">
							
							<div class="member-mail-con">
								<i class="fa fa-envelope" aria-hidden="true"></i>
								<a href="" class="member-mail"></a>
							</div>
							<div class="member-phone-con">
								<i class="fa fa-phone" aria-hidden="true"></i>
								<a class="member-phone" href=""></a>
							</div>
							<div class="member-web-con">
								<i class="fa fa-home" aria-hidden="true"></i>
								<a href="" target="_blank" class="member-web"></a>
							</div>
							<div class="member-face-con"><a href="" target="_blank" class="member-face"><i class="fa fa-facebook" aria-hidden="true"></i></a></div>
						</div>

				</div>
			</div>
		</div>
	</section>
	
<?php
$args = array( 'post_type' => 'medlemmer','posts_per_page' => -1 );
$custom_posts = get_posts($args);
$memberinfo = array();

foreach($custom_posts as $post) : setup_postdata($post);
if(get_field('img_medlemmer')){
	$img = get_field('img_medlemmer');
} else{
	$img = $placeholder;
}
$memberinfo[] = array(
	'name' => get_the_title(),
	'ID' => get_the_ID(),
	'img' => $img,
	'area' => get_field('omrade_medlemmer'),
	'address' => get_field('adresse_medlemmer'),
	'zip' => get_field('postnr_medlemmer'),
	'mail' => get_field('email_medlemmer'),
	'phone' => get_field('tlf_medlemmer'),
	'home' => get_field('hjemmeside_medlemmer'),
	'face' => get_field('facebook_medlemmer'),
	'text' => get_field('tekst_medlemmer')

);
endforeach;

?>

<script type='text/javascript'>
var jqueryarray = <?php echo json_encode($memberinfo); ?>;

</script>
<?php
	
					
get_footer();






