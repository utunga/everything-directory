<?php
/**
 * This widget presents loop content, based on your input, for category listing pages
 *
 * @package EverythingDirectory
 * @author  Miles Thompson
 */
class EverythingDirectory_Listings_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => '', 'description' => __( 'Display an individual DoE listing', 'everything-directory' ) );
		$control_ops = array( 'width' => 600, 'height' => 200, 'id_base' => 'listing-widget'  );
		parent::__construct( 'listing-widget', __( 'DoE - Listings', 'everything-directory' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {

		/** defaults */
		$instance = wp_parse_args( $instance, array(
			'title'  => ''
		) );

		extract( $args );

		echo $before_widget;

            if ( $instance['title'] ) echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;

			$toggle = ''; /** for left/right class */

            $cat = array_key_exists('category', $instance) ? $instance['category'] : get_field('category', 'widget_' . $widget_id);
            $title = array_key_exists('title', $instance) && $instance['title'] ? $instance['title'] : $cat->name;
            $show_title = array_key_exists('show_title', $instance) ?  $instance['show_title'] : true;
            $show_intro = array_key_exists('show_intro', $instance) ?  $instance['show_intro'] : true;
            
            $intro_text = get_term_meta( $cat->term_id, 'intro_text', true );
	        $intro_text = apply_filters( 'genesis_term_intro_text_output', $intro_text ? $intro_text : '' );

            $args = array(
              'post_type'   => 'listing',
              'post_status' => 'publish',
              'tax_query'   => array(
                  array(
                      'taxonomy' => 'category',
                      'field'    => 'slug',
                      'terms'    => $cat->slug
                  )
              )
             );
            ?>
            <div class="directory-widget">
                <?php if ($show_title)  {?>
                    
                    <div class="directory-widget-header">
                    <h2><?php echo $title ?></h2>
                        <?php if ($show_intro && (trim($intro_text))) { ?>
                            <div class="intro-text">
                                <?php echo $intro_text ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php
                }
                elseif ($show_intro)  {?>
                    
                    <div class="directory-widget-header">
                        <?php if (trim($intro_text)) { ?>
                            <div class="intro-text">
                                <?php echo $intro_text ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php
                }
                    $listings = new WP_Query( $args );
                    if( $listings->have_posts() ) :

                                while( $listings->have_posts()) : $listings->the_post();
                                    echo listing_a_z_view(get_the_title(), build_listing($listings->post));
                                endwhile;
                                wp_reset_postdata();
                    else :
                        esc_html_e( 'No listings in this category', 'text-domain' );
                    endif;
                ?>
                </div>
                <?php
			$toggle = $toggle == 'left' ? 'right' : 'left';

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	function form( $instance ) {

		$instance = wp_parse_args( $instance, array(
			'title'          => ''
		) );

        //printf( '<p><label for="%s">%s</label><input type="text" id="%s" name="%s" value="%s" style="%s" /></p>', $this->get_field_id('title'), __( 'Title:', 'everything-directory' ), $this->get_field_id('title'), $this->get_field_name('title'), esc_attr( $instance['title'] ), 'width: 95%;' );

	}
}

function render_listing_widget_for_category($category, $show_title=true, $show_intro=true)  {
    
     $instance = array(
           'category' => $category,
           'show_title' => $show_title,
           'show_intro' => $show_intro
     );
     the_widget('EverythingDirectory_Listings_Widget', $instance);
}
