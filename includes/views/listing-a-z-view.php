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

<div class="directory-item">

    <div class="directory-row">
        <div class="title">
            <?php echo $title ?>
        </div>
    </div>

    <div class="directory-row info-items">
        <?php 
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
    <div class="directory-row">
        <div>
            <?php echo $short_description ?>
        </div>
    </div>
    <div class="directory-row taxonomy">
        <div class="more-button">
            <?php
                printf( '<a href="/listings/%s">&nbsp&nbsp;&nbsp;&nbsp;&nbsp;%s&nbsp;<span class="arrows">&gt;&gt;</span></a>', $listing->slug, "More" );  
            ?>
        </div>
        <div>
            <?php
                echo the_post_tags($listing);
            ?>
        </div>

    </div>

</div>

