<?php
    include( dirname( __FILE__ ) . '/listing-common.php' );
?>

<div class="directory-item">

    <div class="directory-row">
        <div class="title">
            <?php echo $title ?>
        </div>
    </div>

    <div class="directory-row">
        <div class="one-sixth">
            <?php echo $address ?>
        </div>
        <div class="two-sixths">
            <?php echo $opening_hours ?>
        </div>
        <div class="one-sixth">
            <?php echo $phone_number ?>
        </div>
        <div class="two-sixths">
            <?php echo $email_address ?>
        </div>
    </div>
    <div class="directory-row">
        <div>
            <?php echo $short_description ?>
        </div>
    </div>
    <div class="directory-row">
        <div>
            <?php echo the_post_services(); ?>
        </div>
        <div>
            <?php echo the_post_tags(); ?>
        </div>
    </div>

    <?php // echo $contact_name ?>
    <?php // echo $duration ?>

</div>

