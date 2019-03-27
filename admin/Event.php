<?php
/**
 *  event plugins custom post 
 */
namespace Admin;
class Event
{
	
	function __construct()
	{
		// echo "this is";
		$this->functuon_hooking();

	}
	function functuon_hooking(){
		add_action( 'init', [$this,'register_event'] );
		add_filter( 'post_updated_messages', [$this,'posttype_update_messages']);
	}
	function register_event(){
		$labels = array(
			'name'               => _x( 'EMS Events', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Event', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Events', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Event', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Event', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Event', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Event', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Events', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Events', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Events:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
		);
		$args = array(
			'labels'             => $labels,
	                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			// 'rewrite'            => array( 'slug' => 'ems-events' ),
			'rewrite'             => array(
				'slug'       => apply_filters( 'ems_event_slug', 'ems-events' ),
				'with_front' => false
			),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);
		register_post_type( 'ems_events', $args );
	}

	function posttype_update_messages( $messages ) {
		global $post, $post_ID;

		$post_types = get_post_types( array( 'show_ui' => true, '_builtin' => false ), 'objects' );

		foreach( $post_types as $post_type => $post_object ) {

		    $messages[$post_type] = array(
		        0  => '', // Unused. Messages start at index 1.
		        1  => sprintf( __( '%s updated. <a href="%s">View %s</a>' ), $post_object->labels->singular_name, esc_url( get_permalink( $post_ID ) ), $post_object->labels->singular_name ),
		        2  => __( 'Custom field updated.' ),
		        3  => __( 'Custom field deleted.' ),
		        4  => sprintf( __( '%s updated.' ), $post_object->labels->singular_name ),
		        5  => isset( $_GET['revision']) ? sprintf( __( '%s restored to revision from %s' ), $post_object->labels->singular_name, wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		        6  => sprintf( __( '%s published. <a href="%s">View %s</a>' ), $post_object->labels->singular_name, esc_url( get_permalink( $post_ID ) ), $post_object->labels->singular_name ),
		        7  => sprintf( __( '%s saved.' ), $post_object->labels->singular_name ),
		        8  => sprintf( __( '%s submitted. <a target="_blank" href="%s">Preview %s</a>'), $post_object->labels->singular_name, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ), $post_object->labels->singular_name ),
		        9  => sprintf( __( '%s scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview %s</a>'), $post_object->labels->singular_name, date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ), $post_object->labels->singular_name ),
		        10 => sprintf( __( '%s draft updated. <a target="_blank" href="%s">Preview %s</a>'), $post_object->labels->singular_name, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ), $post_object->labels->singular_name ),
		        );
		}

		return $messages;
	}

}