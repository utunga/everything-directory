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
    $page_link = $listing->page_link;
    $has_content = $listing->has_content;
?>

<div class="directory-item">

    <div class="directory-row">
        <div class="title"> <?php
            if ($has_content) 
            {
                printf('<a class="listing_title_link" href="%s">%s</a>', $page_link, $title);  
            }
            else {
                printf('%s', $title);  
            } ?>
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
    <div class="directory-row taxonomy"><?php 
        if ($has_content) 
        {
        ?>
            <div class="more-button">
            <?php
                printf( '<a href="%s">&nbsp&nbsp;&nbsp;&nbsp;&nbsp;%s&nbsp;<span class="arrows">&gt;&gt;</span></a>', $page_link, "More" );  
            ?>
            </div><?php
        }
        ?>
        <div>
            <?php
                echo the_post_tags($listing);
            ?>
        </div>

    </div>

</div>

