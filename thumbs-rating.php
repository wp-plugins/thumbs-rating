<?php
/*
Plugin Name: Thumbs Rating
Plugin URI: http://wordpress.org/plugins/thumbs-rating/
Description: Add thumbs up/down rating to your content.
Author: Ricard Torres
Version: 1.1
Author URI: http://php.quicoto.com/
*/

/*-----------------------------------------------------------------------------------*/
/* Define the URL and DIR path */
/*-----------------------------------------------------------------------------------*/

define('thumbs_rating_url', WP_PLUGIN_URL."/".dirname( plugin_basename( __FILE__ ) ) );
define('thumbs_rating_path', WP_PLUGIN_DIR."/".dirname( plugin_basename( __FILE__ ) ) );


/*-----------------------------------------------------------------------------------*/
/* Init */
/* Localization */
/*-----------------------------------------------------------------------------------*/


if  ( ! function_exists( 'thumbs_rating_init' ) ): 
    
	function thumbs_rating_init() {
	
		load_plugin_textdomain( 'thumbs-rating', false, basename( dirname( __FILE__ ) ) . '/languages' );
	}
	add_action('plugins_loaded', 'thumbs_rating_init');

endif;



/*-----------------------------------------------------------------------------------*/
/* Encue the Scripts for the Ajax call */
/*-----------------------------------------------------------------------------------*/

if  ( ! function_exists( 'thumbs_rating_scripts' ) ): 
	
	function thumbs_rating_scripts()
	{
		wp_enqueue_script('thumbs_rating_scripts', thumbs_rating_url . '/js/general.js', array('jquery'));
		wp_localize_script( 'thumbs_rating_scripts', 'thumbs_rating_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}
	add_action('wp_enqueue_scripts', thumbs_rating_scripts);

endif;


/*-----------------------------------------------------------------------------------*/
/* Encue the Styles for the Thumbs up/down */
/*-----------------------------------------------------------------------------------*/

if  ( ! function_exists( 'thumbs_rating_styles' ) ): 
	
	function thumbs_rating_styles()  
	{ 
	   
	    wp_register_style( "thumbs_rating_styles",  thumbs_rating_url . '/css/style.css' , "", "1.0.0");
	    wp_enqueue_style( 'thumbs_rating_styles' );
	}
	add_action('wp_enqueue_scripts', 'thumbs_rating_styles');	

endif;

/*-----------------------------------------------------------------------------------*/
/* Add the thumbs up/down links to the content */
/*-----------------------------------------------------------------------------------*/

if  ( ! function_exists( 'thumbs_rating_getlink' ) ): 

	function thumbs_rating_getlink($post_ID = '')
	{
		$thumbs_rating_link = "";
		
		if( $post_ID == '' ) $post_ID = get_the_ID();
		
		$thumbs_rating_up_count = get_post_meta($post_ID, '_thumbs_rating_up', true) != '' ? get_post_meta($post_ID, '_thumbs_rating_up', true) : '0';
		$thumbs_rating_down_count = get_post_meta($post_ID, '_thumbs_rating_down', true) != '' ? get_post_meta($post_ID, '_thumbs_rating_down', true) : '0';
		$link_up = '<span class="thumbs-rating-up" onclick="thumbs_rating_vote(' . $post_ID . ', 1);" data-text="' . __('Vote Up','thumbs-rating') . '"> +' . $thumbs_rating_up_count . '</span>';
		 $link_down = '<span class="thumbs-rating-down" onclick="thumbs_rating_vote(' . $post_ID . ', 0);" data-text="' . __('Vote Down','thumbs-rating') . '"> -' . $thumbs_rating_down_count . '</span>';
		$thumbs_rating_link = '<div  class="thumbs-rating-container" id="thumbs-rating-'.$post_ID.'">';
		$thumbs_rating_link .= $link_up;
		$thumbs_rating_link .= ' ';
		$thumbs_rating_link .= $link_down;
		$thumbs_rating_link .= '<span class="thumbs-rating-already-voted" data-text="' . __('You already voted!', 'thumbs-rating') . '"></span>';
		$thumbs_rating_link .= '</div>';
		
		return $thumbs_rating_link;
	}
	
endif;


/*-----------------------------------------------------------------------------------*/
/* Print the Thumbs Rating links to the_content  */
/* We've commented this part because the user will control where to show the thumbs */
/*-----------------------------------------------------------------------------------*/

/*
if  ( ! function_exists( 'thumbs_rating_print' ) ): 

	function thumbs_rating_print($content)
	{
		return $content.thumbs_rating_getlink();
	}
	add_filter('the_content', thumbs_rating_print);

endif;
*/


/*-----------------------------------------------------------------------------------*/
/* Handle the Ajax request to vote up or down */
/*-----------------------------------------------------------------------------------*/

if  ( ! function_exists( 'thumbs_rating_add_vote_callback' ) ): 

	function thumbs_rating_add_vote_callback()
	{
	
		global $wpdb;
		
		// Get the POST values
		
		$post_ID = intval( $_POST['postid'] );
		$type_of_vote = intval( $_POST['type'] );
		
		// Check the type and retrieve the meta values
		
		if ( $type_of_vote == 0 ){
		
			$meta_name = "_thumbs_rating_down";
			
		}elseif( $type_of_vote == 1){
		
			$meta_name = "_thumbs_rating_up";
		
		}
	
		// Retrieve the meta value from the DB
		
		$thumbs_rating_count = get_post_meta($post_ID, $meta_name, true) != '' ? get_post_meta($post_ID, $meta_name, true) : '0';		
		$thumbs_rating_count = $thumbs_rating_count + 1;
		
		// Update the meta value
		
		update_post_meta($post_ID, $meta_name, $thumbs_rating_count);
							
		$results = thumbs_rating_getlink($post_ID);

		die($results);
	}

	add_action( 'wp_ajax_thumbs_rating_add_vote', 'thumbs_rating_add_vote_callback' );
	add_action('wp_ajax_nopriv_thumbs_rating_add_vote', 'thumbs_rating_add_vote_callback');
	
endif;
