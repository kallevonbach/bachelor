<div class="container">
    <h1>Grupper</h1>
    <p>Donec tempor id tellus sed eleifend. Suspendisse dapibus eros ac rutrum ultricies. Integer quis placerat nibh. Duis cursus eleifend nulla non fringilla. Mauris fringilla nisi sed feugiat ornare. Nulla id sodales leo. Morbi facilisis ipsum non sodales hendrerit. Proin a efficitur sapien. Praesent mollis molestie varius.</p>
	<div class="grupper-oversigt">

	
        <?php
        $i=0;
        foreach ($attributes as $term) :?>
        <?php  $groupID = $term->term_taxonomy_id;  ?>
        <?php $image = get_field('grupper_featured_image', $term); ?>
            <?php if($i % 3 == 0){
            echo '<div class="row-wrapper">';
            }
        $i++ ?>
        <div class="col-4">
            <a class="testclick" href="emne-oversigt?groupid=<?php echo $groupID?>">
                <div class="desc-overlay">
                    <img class="preview" src="<?php if ($image) { echo $image;} else { echo site_url() . '/wp-content/uploads/2017/11/phblack.png'; } ?>" />
                    <span class="desc"><?php if ($term->description) { echo $term->description; } else { echo 'Denne gruppe har endnu ingen beskrivelse...'; } ?></span>
                </div>
                <h3><?php echo $term->name; ?></h3>
            </a>

        </div>
        <?php if($i % 3 == 0){
            echo '</div>';
            }
        endforeach; ?>
    </div>
</div>