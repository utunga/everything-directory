<?php
    include( dirname( __FILE__ ) . '/listing-common.php' );
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBezI3iiTQh5FbkfMhBwG1St41i_PqB3VQ"></script>
<div class="directory-sidebar">    
    
    <?php
    $location = get_field('map');
    if( !empty($location) ) {
    ?>
    <div class="acf-map">
        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
    </div><?php } ?>

    <div><?php echo $address ?></div>
    <div><?php echo $opening_hours ?>
    </div>
    <div><?php echo $phone_number ?>
    </div>
    <div><?php echo $email_address ?>
    </div>



    <div><?php echo the_post_services(); ?>
    </div>

    <div><?php echo the_post_tags(); ?>
    </div>

    <div>
        <b>Last Updated:</b><br/>
        <?php echo ed_the_last_updated() ?>
    </div>
    
    <?php // echo $contact_name ?><?php // echo $duration ?>

</div>


