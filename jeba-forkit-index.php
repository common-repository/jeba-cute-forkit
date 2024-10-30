<?php
/*
Plugin Name: Jeba Cute forkit
Plugin URI: http://prowpexpert.com/jeba-cute-forkit/
Description: This is Jeba cute wordpress forkit plugin really looking awesome sliding. Everyone can use the cute forkit plugin easily like other wordpress plugin. Here everyone can featured image from post, page or other custom post. Also can use featured from every category. By using [jeba_forkit] shortcode use the forkit every where post, page and template.
Author: Md Jahed
Version: 1.0
Author URI: http://prowpexpert.com/
*/
function jebas_wp_latestss_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'jebas_wp_latestss_jquery');

function plugin_function_jeba_silderss() {
    wp_enqueue_style( 'jeba-cssss', plugins_url( '/css/style.css', __FILE__ ));
    wp_enqueue_style( 'jeba-forkitcss', plugins_url( '/css/forkit.css', __FILE__ ));
}

add_action('init','plugin_function_jeba_silderss');
function plugin_function_jeba_forkit() {
    wp_enqueue_script( 'jeba-forkit-js', plugins_url( '/js/forkit.js', __FILE__ ), true);
}

add_action('wp_footer','plugin_function_jeba_forkit');

function jebas_forkit_shortcode($atts){
	extract( shortcode_atts( array(
		'title' => 'Here is title',
		'text' => 'Top Secret',
		'category' => '',
		'post_type' => '',
		'count' => '4',
	), $atts) );
	
    $q = new WP_Query(
        array('posts_per_page' => $count, 'post_type' => $post_type, 'category_name' => $category)
        );		
		
		$plugins_url = plugins_url();
		
	$list = '
		<div class="forkit-curtain">
			<div class="close-button"></div>
			<h2>'.$title.'</h2><br/>';
	while($q->have_posts()) : $q->the_post();
		$idd = get_the_ID();
		
		$list .= '
			<a href="'.get_permalink().'" title="'.get_the_title().'">' . get_the_post_thumbnail($post_id, 'thumbnail') . '</a>

		
		';        
	endwhile;
	$list.= '</div>

		<!-- The ribbon -->
		<a class="forkit" data-text="'.$text.'" data-text-detached="Drag down >" href=""></a>
';
	wp_reset_query();
	return $list;
}
add_shortcode('jeba_forkit', 'jebas_forkit_shortcode');

?>