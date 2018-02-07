<?php 
	
	
$secure_groupid = (int)$_GET['groupid'];


$the_query = new WP_Query( array(
            'post_type' => 'grupper_post',
            'tax_query' => array(
			array(
			'taxonomy' => 'grupper_tax',
			'field' => 'term_id',
			'terms' => $secure_groupid
     )
  )
)); ?>
     <div class="container">
	 <h1>Indlæg</h1>
	     <div class="post-in-topic">
		
<?php
if ( $the_query->have_posts() ) {
	echo '<table id="topic-posts" style="width:100%"><tr>';
	echo '<th style="width:40%">Emne</th>';
	echo '<th style="width:20%">Kommentarer</th>';
	echo '<th style="width:20%">Forfatter</th>';
	echo '<th style="width:20%">Udgivet</th></tr>'; 
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		echo '<tr><td style="width:40%"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></td><td style="width:20%">' . get_comments_number() . '</td><td style="width:20%">'. get_the_author() .'</td><td style="width:20%">'. get_the_date().'</td></tr>';
	}
	/* Restore original Post Data */
	wp_reset_postdata();
	echo '</table>';
} else {
	echo 'Dette emne har ingen artikler endnu';
}
?>
     	</div>
		<div class="write-post">
			<a href="insert_post?groupid=<?php echo $secure_groupid?>">skriv indlæg</a>
		</div>
	 </div>