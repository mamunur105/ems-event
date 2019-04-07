<?php
/**
 *  event plugins custom post 
 */
namespace ems\apps\admin;
class Event
{
	
	function __construct()
	{
		// echo "this is";
		$this->functuon_hooking();

	}
	function functuon_hooking(){
		add_action( 'init', [$this,'register_event'] );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_filter( 'post_updated_messages', [$this,'posttype_update_messages']);
	}
	function register_event(){
		$labels = array(
			'name'               => _x( 'EMS Events', 'post type general name', 'emsevent' ),
			'singular_name'      => _x( 'Event', 'post type singular name', 'emsevent' ),
			'menu_name'          => _x( 'Events', 'admin menu', 'emsevent' ),
			'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'emsevent' ),
			'add_new'            => _x( 'Add New', 'book', 'emsevent' ),
			'add_new_item'       => __( 'Add New Event', 'emsevent' ),
			'new_item'           => __( 'New Event', 'emsevent' ),
			'edit_item'          => __( 'Edit Event', 'emsevent' ),
			'view_item'          => __( 'View Event', 'emsevent' ),
			'all_items'          => __( 'All Events', 'emsevent' ),
			'search_items'       => __( 'Search Events', 'emsevent' ),
			'parent_item_colon'  => __( 'Parent Events:', 'emsevent' ),
			'not_found'          => __( 'No books found.', 'emsevent' ),
			'not_found_in_trash' => __( 'No books found in Trash.', 'emsevent' )
		);
		$args = array(
			'labels'             => $labels,
	                'description'        => __( 'Description.', 'emsevent' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
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
	function register_taxonomies(){
		$labels = array(
			'name'               => 'Event Category',
			'all_items'          => sprintf( __( "All %s", 'emsevent' ), 'Event Categories' ),
			'singular_name'      =>  __( 'Event Category', 'emsevent' ),
			'add_new'            => sprintf( __( 'New %s', 'emsevent' ), 'Event Category' ),
			'add_new_item'       => sprintf( __( 'Add New %s', 'emsevent' ), 'Event Category' ),
			'edit_item'          => sprintf( __( 'Edit %s', 'emsevent' ), 'Event Category' ),
			'new_item'           => sprintf( __( 'New %s', 'emsevent' ), 'Event Category' ),
			'view_item'          => sprintf( __( 'View %s', 'emsevent' ), 'Event Category' ),
			'search_items'       => sprintf( __( 'Search %s', 'emsevent' ), 'Event Categories' ),
			'not_found'          => sprintf( __( 'No %s found', 'emsevent' ), 'Event Categories' ),
			'not_found_in_trash' => sprintf( __( 'No %s found in Trash', 'emsevent' ), 'Event Categories' ),
			'parent_item_colon'  => sprintf( __( 'Parent %s:', 'emsevent' ), 'Event Category' ),
			'menu_name'          => 'Event Category',
		);
		register_taxonomy( 'ems_event_category', array( 'ems_events' ), array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => apply_filters( 'emsevent_category_slug', 'emsevent-category' ) )
		) );
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