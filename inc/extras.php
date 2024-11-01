<?php
/**
 * Custom functions for the plugin
 */

/**
 * Plugin Options Defaults
 *
 * Sane Defaults Logic
 * Plugin will not save default settings to the database without explicit user action
 * and Plugin will function properly out-of-the-box without user configuration.
 *
 * @param string $option - Name of the option to retrieve.
 * @return mixed
 */
function wpflask_ac_option_default( $option = 'posts_modifed_column' ) {

	$wpflask_ac_options_default = array (
		'posts_modifed_column'   => 'no',
		'posts_thumbnail_column' => 'no',
		'pages_modifed_column'   => 'no',
		'pages_thumbnail_column' => 'no'
	);

	if( isset( $wpflask_ac_options_default[$option] ) ) {
		return $wpflask_ac_options_default[$option];
	}

	return '';

}

/**
 * Retrieve the plugin option.
 *
 * @param string $option - Name of the option to retrieve.
 * @return mixed
 */
function wpflask_ac_option( $option = 'posts_modifed_column' ) {

	$wpflask_ac_options = apply_filters( 'wpflask_ac_options', get_option( 'wpflask_ac_options' ) );

	if ( isset( $wpflask_ac_options[$option] ) ) {
		return $wpflask_ac_options[$option];
	} else {
		return wpflask_ac_option_default( $option );
	}

}

/**
 * Register Post Column
 *
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/manage_posts_columns
 */
function wpflask_ac_add_posts_column( $columns ) {

	// Post Modified Column
	if ( 'yes' === wpflask_ac_option( 'posts_modifed_column' ) ) {
		$columns['wpflask_ac_post_modified_column'] = 'Last Modified';
	}

	// Post Thumbnail Column
	if ( 'yes' === wpflask_ac_option( 'posts_thumbnail_column' ) ) {
		// Re-order Post Thumnbail
		$columns_new = array();
		$re_order = false;
		foreach( $columns as $key => $val ) {
			if ( 'author' === $key ) {
				$columns_new['wpflask_ac_post_thumbnail_column'] = 'Thumbnail';
				$re_order = true;
			}
			$columns_new[$key] = $val;
		}

		// Re-order Validation
		if ( false === $re_order ) {
			$columns_new['wpflask_ac_post_thumbnail_column'] = 'Thumbnail';
		}

		$columns = $columns_new;
	}

	return $columns;

}
add_filter( 'manage_posts_columns', 'wpflask_ac_add_posts_column' );

/**
 * Register Page Column
 *
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/manage_pages_columns
 */
function wpflask_ac_add_pages_column( $columns ) {

	// Page Modified Column
	if ( 'yes' === wpflask_ac_option( 'pages_modifed_column' ) ) {
		$columns['wpflask_ac_page_modified_column'] = 'Last Modified';
	}

	// Post Thumbnail Column
	if ( 'yes' === wpflask_ac_option( 'pages_thumbnail_column' ) ) {
		// Re-order Post Thumnbail
		$columns_new = array();
		$re_order = false;
		foreach( $columns as $key => $val ) {
			if ( 'author' === $key ) {
				$columns_new['wpflask_ac_page_thumbnail_column'] = 'Thumbnail';
				$re_order = true;
			}
			$columns_new[$key] = $val;
		}

		// Re-order Validation
		if ( false === $re_order ) {
			$columns_new['wpflask_ac_page_thumbnail_column'] = 'Thumbnail';
		}

		$columns = $columns_new;
	}

	return $columns;

}
add_filter( 'manage_pages_columns', 'wpflask_ac_add_pages_column' );

/**
 * Add Post Column Content
 *
 * @see https://codex.wordpress.org/Plugin_API/Action_Reference/manage_posts_custom_column
 */
function wpflask_ac_add_posts_column_content( $column, $post_id ) {

	// Post Modified Column
	if ( 'wpflask_ac_post_modified_column' === $column ) {
		echo esc_html__( 'Modified', 'wpflask-admin-columns' ) . '<br />';
		the_modified_time( 'Y/m/d' );
		echo '<br />';
		the_modified_time( 'g:i A' );
	}

	// Post Thumbnail Column
	if ( 'wpflask_ac_post_thumbnail_column' === $column ) {
		the_post_thumbnail( array( 50, 50 ) );
	}

}
add_filter( 'manage_posts_custom_column', 'wpflask_ac_add_posts_column_content', 10, 2 );

/**
 * Add Page Column Content
 *
 * @see https://codex.wordpress.org/Plugin_API/Action_Reference/manage_pages_custom_column
 */
function wpflask_ac_add_pages_column_content( $column, $post_id ) {

	// Post Modified Column
	if ( 'wpflask_ac_page_modified_column' === $column ) {
		echo esc_html__( 'Modified', 'wpflask-admin-columns' ) . '<br />';
		the_modified_time( 'Y/m/d' );
		echo '<br />';
		the_modified_time( 'g:i A' );
	}

	// Post Thumbnail Column
	if ( 'wpflask_ac_page_thumbnail_column' === $column ) {
		the_post_thumbnail( array( 50, 50 ) );
	}

}
add_filter( 'manage_pages_custom_column', 'wpflask_ac_add_pages_column_content', 10, 2 );

/**
 * Register Post Sortable Column
 *
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/manage_edit-post_type_columns
 */
function wpflask_ac_add_posts_sortable_column( $columns ) {
	// Post Modified Column
	if ( 'yes' === wpflask_ac_option( 'posts_modifed_column' ) ) {
		$columns['wpflask_ac_post_modified_column'] = array( 'wpflask_ac_date_modified', 1 );
	}

	return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'wpflask_ac_add_posts_sortable_column' );

/**
 * Register Page Sortable Column
 *
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/manage_edit-post_type_columns
 */
function wpflask_ac_add_pages_sortable_column( $columns ) {
	// Page Modified Column
	if ( 'yes' === wpflask_ac_option( 'pages_modifed_column' ) ) {
		$columns['wpflask_ac_page_modified_column'] = array( 'wpflask_ac_date_modified', 1 );
	}

	return $columns;
}
add_filter( 'manage_edit-page_sortable_columns', 'wpflask_ac_add_pages_sortable_column' );

/**
 * Only run our customization on the 'edit.php' page in the admin.
 *
 * @see http://justintadlock.com/archives/2011/06/27/custom-columns-for-custom-post-types
 * @see https://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
 */
function wpflask_ac_posts_load() {
	if ( 'yes' === wpflask_ac_option( 'posts_modifed_column' ) || 'yes' === wpflask_ac_option( 'pages_modifed_column' ) ) {
		add_action( 'pre_get_posts', 'wpflask_ac_pre_get_posts_sortable_column' );
	}
}
add_action( 'load-edit.php', 'wpflask_ac_posts_load' );

/**
 * Modify Query
 *
 * @see https://codex.wordpress.org/Function_Reference/is_main_query
 */
function wpflask_ac_pre_get_posts_sortable_column( $query ){

	$orderby = $query->get( 'orderby');
	if ( isset( $orderby ) && 'wpflask_ac_date_modified' === $orderby && $query->is_main_query() ) {
		$query->set( 'orderby', 'modified' );
	}

}
