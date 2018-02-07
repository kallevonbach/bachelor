<div class="container">
    <div class="grupper-oversigt">
        
<?php
    if(!is_user_logged_in()){
    ?>
    <p>For at se denne gruppe, skal du logge ind</p>
    <div class="knapper">
        <a href="member-login">Log in</a>
        <a href="member-register">Opret bruger</a>
    </div>
    <?php
    } else {

    if (is_array($attributes)) {
    echo '<div class="row-wrapper">';
    foreach ($attributes as $term) :
    $image = get_field('grupper_featured_image', $term);
    ?>
        <div class="col-4">
            <a class="testclick" href="post-oversigt?groupid=<?php echo $term->term_taxonomy_id?>">
                <div class="desc-overlay">
                    <div class="preview" style="background-image: url('<?php if ($image) { echo $image;} else { echo site_url() . '/wp-content/uploads/2017/11/phblack.png'; } ?>'"></div>
                    <span class="desc"><?php echo $term->description ?></span>
                </div>
                <h3><?php echo $term->name;?></h3>
            </a>
        </div>
        <?php 
    endforeach;
    
    
    } else {
    
        
    ?>

    <a href="applied?applyforgroup=<?php echo $attributes?>">  Ansøg om medlemskab til gruppen </a> 
    
    
    <?php }
    } 
    ?>
    
    </div>
    </div>