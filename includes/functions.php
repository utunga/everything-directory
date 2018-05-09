<?php
/**
 * Holds miscellaneous functions for use in the Everything Directory plugin
 *
 */


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


function listing_a_z_view() {
    include( dirname( __FILE__ ) . '/views/listing-a-z-view.php' );
}

function listing_sidebar_view() {
    include( dirname( __FILE__ ) . '/views/listing-sidebar-view.php' );
}
