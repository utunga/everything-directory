<?php

//some useful functions
if (!function_exists( 'get_services_html')) {
    function get_services_html($service_0, $service_1, $service_2) {
        $tmp = array($service_0, $service_1, $service_2);
        $services = array_filter($tmp);
        $comma_separated = implode(', ', array_map(function($i) {  return $i->name; }, $services));
        return $comma_separated;
    }
    function the_post_services() {
        return get_services_html(get_field('service_0'),  get_field('service_1'),  get_field('service_2'));
    }
    function the_post_tags() {
        return "";
    }

    function ed_the_last_updated() {
        $updated_date = get_the_modified_time('F jS, Y');
        $updated_time = get_the_modified_time('h:i a');
        return 'On '. $updated_date . ' at '. $updated_time;  
        
    } 
}


$title = get_the_title();
$contact_name = get_field("contact_name");
$address = get_field("address");
$short_description = get_field("short_description");
$phone_number = get_field("phone_number");
$email_address = get_field("email_address");
$opening_hours = get_field("opening_hours");
$duration = get_field("duration");
$map = get_field("map");

?>
