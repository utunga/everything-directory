<?php
/**
 * Holds miscellaneous functions for use in the Everything Directory plugin
 *
 */


// UTIL functions 

/**
 * Returns true if the given predicate is true for all elements.
 */
function array_every(callable $callback, array $arr) {
  foreach ($arr as $element) {
    if (!$callback($element)) {
      return FALSE;
    }
  }
  return TRUE;
}
/**
 * Returns true if the given predicate is true for at least one element.
 */
function array_any(callable $callback, array $arr) {
  foreach ($arr as $element) {
    if ($callback($element)) {
      return TRUE;
    }
  }
  return FALSE;
}

/**
 * Returns true if item content not empty
 */
function not_empty($item) {
    return (trim($item));
}

/**
 * This function redirects the user to an admin page, and adds query args
 * to the URL string for alerts, etc.
 *
 * This is just a temporary function, until WordPress fixes add_query_arg(),
 * or Genesis 1.8 is released, whichever comes first.
 *
 */
function apl_admin_redirect( $page, $query_args = array() ) {

	if ( ! $page )
		return;

	$url = html_entity_decode( menu_page_url( $page, 0 ) );

	foreach ( (array) $query_args as $key => $value ) {
		if ( isset( $key ) && isset( $value ) ) {
			$url = add_query_arg( $key, $value, $url );
		}
	}

	wp_redirect( esc_url_raw( $url ) );

}

genesis_register_sidebar( array(
	'id'		=> 'sidebar-everythingdir-listing',
	'name'		=> __( 'Listing Sidebar', 'nabm' ),
	'description'	=> __( 'This is the sidebar for Everything Directory listings.', 'nabm' ),
) );

// Swap sidebars on listing type pages
add_action('get_header','child_change_genesis_sidebar');
function child_change_genesis_sidebar() {
    if ( is_singular('listing')) { 
        remove_action( 'genesis_sidebar', 'genesis_do_sidebar' ); //remove the default genesis sidebar
        add_action( 'genesis_sidebar', 'everythingdir_listing_sidebar' ); //add an action hook to call the function for my custom sidebar
    }
}
  
// Output sidebar with the id 'sidebar-everythingdir-listing'
function everythingdir_listing_sidebar() {
    genesis_widget_area( 'sidebar-everythingdir-listing' );
}


function listing_a_z_view($title, $listing) {
    include( dirname( __FILE__ ) . '/views/listing-a-z-view.php' );
}

function listing_sidebar_view($listing) {
    include( dirname( __FILE__ ) . '/views/listing-sidebar-view.php' );
}

// only works within the_loop
function build_listing($page) {
    
    $services = array_filter(array(get_field('service_0'),  get_field('service_1'),  get_field('service_2')));
    return (object) [
        "ID" => $page->ID,
        "slug" => $page->post_name,
	    "contact_name" => get_field("contact_name"),
	    "address" => get_field("address"),
	    "phone_number" => get_field("phone_number"),
	    "email_address" => get_field("email_address"),
	    "opening_hours" => get_field("opening_hours"),
	    "duration" => get_field("duration"),
	    "map" => get_field("map"),
	    "website" => get_field("website"),
	    "logo" => get_field("logo"),
	    "short_description" => get_field("short_description"),
        "services" => $services,
        "title" => get_the_title()
       
    ];
    
}