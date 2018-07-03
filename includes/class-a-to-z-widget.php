<?php
/**
 * This widget presents the entire list of all posts in a-z format
 *
 * @package EverythingDirectory
 * @author  Miles Thompson
 */
class EverythingDirectory_A_to_Z_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => '', 'description' => __( 'Display everything as one big a-z list', 'everything-directory' ) );
		$control_ops = array( 'width' => 600, 'height' => 200, 'id_base' => 'a-to-z-widget'  );
		parent::__construct( 'a-to-z-widget', __( 'A_to_Z - Listings', 'everything-directory' ), $widget_ops, $control_ops );
	}

    function expand_out_listings($listings) {
        $result = array();
        foreach ($listings as $title => $listing) {
            if ($listing->services):
                foreach($listing->services as $service) {
                    $use_this_title = $service->name . " - " . $listing->title;
                    $result[$use_this_title] = $listing;
                }
            else:
                $result[$title] = $listing;
            endif;
        }
        return $result;            
    }

     function index_by_first_letter($sorted_listings) {
        $result = array();
        foreach ($sorted_listings as $title_to_use => $listing) {
            $tmp = mb_strtolower($title_to_use, 'UTF-8');
            $tmp = preg_replace('/^paekakariki /', '', $tmp);
            $tmp = preg_replace('/^paekākāriki /u', '', $tmp);
            $tmp = preg_replace('/^the /', '', $tmp);
            $tmp = preg_replace('/^a /', '', $tmp);
            if (empty($tmp))
                $tmp = "_";
            $letter = strtoupper($tmp)[0];
            if (!array_key_exists($letter, $result))
                $result[$letter] = array();
           $result[$letter][$title_to_use] = $listing;
        }
        ksort($result);
        return $result;            
    }

	function widget( $args, $instance ) {

		extract( $args );

		echo $before_widget;
        $args = array(
            'post_type'   => 'listing',
            'post_status' => 'publish',
            );
        ?>
        <script>

         jQuery(document).ready(function ($) {
             $('#a_to_z_widget').liveFilter('#livefilter-input', '.a_to_z_section', {
                 filterChildSelector: '.directory-item',
                 filter: function (el, val) {
                     return $(el).text().toUpperCase().indexOf(val.toUpperCase()) >= 0;
                 },
                 after: function (contains, containsNot) {
                     if (containsNot.length) {
                         $(".a_to_z_letter_heading").hide();
                     }
                     else {
                         $(".a_to_z_letter_heading").show();
                     }
                 }
            });
          });
        </script>
        <div id="a_to_z_widget" class="directory-widget">
            <div class="a_to_z_searchbar">
                <div class="wrap">
                    <input id="livefilter-input" class="search" type="text" value="">
                    <input type="button" value="search" class="search_button" />
                </div>
            </div>
            <div class="a_to_z_jumplinks">
            <ul>
                <li><a href="#a">A-J</a></li>
                <li><a href="#a">K-N</a></li>
                <li><a href="#a">O-S</a></li>
                <li><a href="#a">T-Z</a></li>
            </ul>
        </div>

        <?php

            $listings = array();

            $listings_query = new WP_Query( $args );
            if( $listings_query->have_posts() ) :
                while( $listings_query->have_posts()) : $listings_query->the_post();
                    $listing = build_listing($listings_query->post);
                    $listings[$listing->title] = $listing;
                endwhile;
            endif;

            $listings = $this->expand_out_listings($listings);
            ksort($listings);
            $listings_by_letter = $this->index_by_first_letter($listings);

            foreach($listings_by_letter as $letter=> $listings) {
                ?>
             <a name="<?php echo $letter ?>"><div class="a_to_z_letter_heading"><h3><?php echo $letter ?></h3></div></a>
                <div class="a_to_z_section">
                    <?php
                    foreach ($listings as $title => $listing)
                        echo listing_a_z_view($title,$listing);
                    ?>
                </div>
                <?php
            }

            wp_reset_postdata();

        ?>
        </div>   
        <?php
         echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    function form( $instance ) {
    }
}
