<?php
    include( dirname( __FILE__ ) . '/listing-common.php' );
    $contact_name = $listing->contact_name;
    $address = $listing->address;
    $phone_number = $listing->phone_number;
    $email_address = $listing->email_address;
    $opening_hours = $listing->opening_hours;
    $duration = $listing->duration;
    $map = $listing->map;
    $website = $listing->website;
    $logo = $listing->logo;
    $short_description = $listing->short_description;
?>

<!-- FIXME Really this is needed - but it clashes with the 
     Events calendar pro google maps API !!! key so comment this one out here. 

    PHP/Wordpress is just such a clusterf**k of messy code. Argh!-->
<!--<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_API_KEY ?>;ver=4.4.31"></script>-->


<div class="directory-sidebar"><?php
    $location = get_field('map');
    ?>
    <div class="info-items">
    <?php 
        if( !empty($location) ) {
    ?>
        <div class="acf-map">
            <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
        </div>
    <?php } 

        if (array_any("not_empty", array( $website))) {
            echo '<div class="item-lg">';  
     
            if (not_empty($website)) {
                    echo sprintf( '<div class="website"><a href="%s" target="_blank">Visit website</a></div>',$website);  
            }
            echo('</div>');  
        }

        echo itemInDiv($address, "item");
        echo itemsInDiv(array($opening_hours, $duration), "item");
        echo itemsInDiv(array($contact_name, $phone_number, $email_address), "item-sm");
    ?>
    </div>

    <div class="w taxonomy">
        <div>
            <?php
                echo the_post_tags($listing);
            ?>
        </div>
    </div>

</div>

    <div>
        <b>This page Last Updated:</b><br /><?php echo ed_the_last_updated() ?>
    </div><?php // echo $contact_name ?><?php // echo $duration ?>

</div>


