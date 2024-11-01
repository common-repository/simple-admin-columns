<?php
/**
 * Admin page for the plugin
 */

/**
 * Settings Page
 */
function wpflask_ac_settings_page() {
	add_submenu_page( 'options-general.php', esc_html__( 'Simple Admin Columns', 'wpflask-admin-columns' ), esc_html__( 'Simple Admin Columns', 'wpflask-admin-columns' ), 'manage_options', 'wpflask-admin-columns', 'wpflask_ac_settings_page_content' );
}
add_action( 'admin_menu', 'wpflask_ac_settings_page' );

/**
 * Settings Page Content
 */
function wpflask_ac_settings_page_content() {
	require WPFLASK_AC_DIR . 'inc/settings-page.php';
}

/**
 * Enqueue scripts and styles.
 */
function wpflask_ac_admin_scripts( $hook ) {

	if( 'settings_page_wpflask-admin-columns' === $hook ) {

		/**
		 * Enqueue JS files
		 */

		// Cookie
		wp_enqueue_script( 'wpflask-ac-cookie', WPFLASK_AC_URI . 'js/cookie.js', array( 'jquery' ) );

		// Admin JS
		wp_enqueue_script( 'wpflask-ac-admin', WPFLASK_AC_URI . 'js/admin.js', array( 'jquery' ) );

		/**
		 * Enqueue CSS files
		 */

		// Admin Style
		wp_enqueue_style( 'wpflask-ac-admin-style', WPFLASK_AC_URI . 'css/admin.css' );

	}

}
add_action( 'admin_enqueue_scripts', 'wpflask_ac_admin_scripts' );

/**
 * Contextual Help
 */
function wpflask_ac_contextual_help() {

	// Plugin Data
	//$plugin    = wpflask_ac_plugin_data();
	//$AuthorURI = $plugin['AuthorURI'];
	//$PluginURI = $plugin['PluginURI'];
	//$Name      = $plugin['Name'];

	// Current Screen
	$screen = get_current_screen();

	// Help Strings
	$content_support = '<p>';
	$content_support .= sprintf( esc_html__( '%1$s is a project of %2$s. You can reach us via contact page.', 'wpflask-admin-columns' ), 'Simple Admin Columns', '<a href="https://wpflask.com/">WPFlask</a>' );
	$content_support .= '<p>';

	// Plugin reference help screen tab.
	$screen->add_help_tab( array (
			'id'         => 'wpflask-ac-support',
			'title'      => esc_html__( 'Plugin Support', 'wpflask-admin-columns' ),
			'content'    => $content_support,
		)
	);

	// Help Sidebar
	$sidebar = '<p><strong>' . esc_html__( 'For more information:', 'wpflask-admin-columns' ) . '</strong></p>';
	$sidebar .= '<p><a href="https://wpflask.com" target="_blank">' . esc_html__( 'Plugin Author', 'wpflask-admin-columns' ) . '</a></p>';
	$sidebar .= '<p><a href="https://wpflask.com/simple-admin-columns/" target="_blank">' . esc_html__( 'Plugin Official Page', 'wpflask-admin-columns' ) . '</a></p>';
	$screen->set_help_sidebar( $sidebar );

}
add_action( 'load-settings_page_wpflask-admin-columns', 'wpflask_ac_contextual_help' );

/**
 * Plugin Settings
 */
function wpflask_ac_settings() {

	// Register plugin settings
	register_setting( 'wpflask_ac_options_group', 'wpflask_ac_options', 'wpflask_ac_options_validate' );

	/** Posts Section */
	add_settings_section( 'wpflask_ac_section_posts', esc_html__( 'Posts Columns', 'wpflask-admin-columns' ), 'wpflask_ac_section_posts_cb', 'wpflask_ac_section_posts_page' );
	add_settings_field( 'wpflask_ac_field_posts_modifed_column', esc_html__( 'Modified Date Column (Sortable)', 'wpflask-admin-columns' ), 'wpflask_ac_field_posts_modifed_column_cb', 'wpflask_ac_section_posts_page', 'wpflask_ac_section_posts' );
	add_settings_field( 'wpflask_ac_field_posts_thumbnail_column', esc_html__( 'Post Thumbnail', 'wpflask-admin-columns' ), 'wpflask_ac_field_posts_thumbnail_column_cb', 'wpflask_ac_section_posts_page', 'wpflask_ac_section_posts' );

	/** Pages Section */
	add_settings_section( 'wpflask_ac_section_pages', esc_html__( 'Pages Columns', 'wpflask-admin-columns' ), 'wpflask_ac_section_pages_cb', 'wpflask_ac_section_pages_page' );
	add_settings_field( 'wpflask_ac_field_pages_modifed_column', esc_html__( 'Modified Date Column (Sortable)', 'wpflask-admin-columns' ), 'wpflask_ac_field_pages_modifed_column_cb', 'wpflask_ac_section_pages_page', 'wpflask_ac_section_pages' );
	add_settings_field( 'wpflask_ac_field_pages_thumbnail_column', esc_html__( 'Post Thumbnail', 'wpflask-admin-columns' ), 'wpflask_ac_field_pages_thumbnail_column_cb', 'wpflask_ac_section_pages_page', 'wpflask_ac_section_pages' );

}
add_action( 'admin_init', 'wpflask_ac_settings' );

/**
 * Bool Options - Yes|No
 */
function wpflask_ac_select_bool_options() {
	return array (
		'yes' => esc_html__( 'yes', 'wpflask-admin-columns' ),
		'no'  => esc_html__( 'no',  'wpflask-admin-columns' )
	);
}

/**
 * Plugin Settings Validation
 */
function wpflask_ac_options_validate( $input ) {

	// Posts Modified Column
	if ( ! array_key_exists( $input['posts_modifed_column'], wpflask_ac_select_bool_options() ) ) {
		 $input['posts_modifed_column'] = wpflask_ac_option_default( 'posts_modifed_column' );
	}

	// Posts Thumbnail Column
	if ( ! array_key_exists( $input['posts_thumbnail_column'], wpflask_ac_select_bool_options() ) ) {
		 $input['posts_thumbnail_column'] = wpflask_ac_option_default( 'posts_thumbnail_column' );
	}

	// Pages Modified Column
	if ( ! array_key_exists( $input['pages_modifed_column'], wpflask_ac_select_bool_options() ) ) {
		 $input['pages_modifed_column'] = wpflask_ac_option_default( 'pages_modifed_column' );
	}

	// Pages Thumbnail Column
	if ( ! array_key_exists( $input['pages_thumbnail_column'], wpflask_ac_select_bool_options() ) ) {
		 $input['pages_thumbnail_column'] = wpflask_ac_option_default( 'pages_thumbnail_column' );
	}

	// return validated array
	return $input;

}

/**
 * Posts Section Callback
 */
function wpflask_ac_section_posts_cb() {
	echo '<div class="section-form-desc">
	  <p class="description">'. esc_html__( 'Configure posts columns by using the following settings.', 'wpflask-admin-columns' ) .'</p>
	</div>';
}

/* Posts Modified Column Callback */
function wpflask_ac_field_posts_modifed_column_cb() {

	// Available Options
	$items = wpflask_ac_select_bool_options();

	// Markup
	echo '<select id="posts_modifed_column" name="wpflask_ac_options[posts_modifed_column]">';
	foreach( $items as $key => $val ) {
	?>
    <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, wpflask_ac_option( 'posts_modifed_column' ) ); ?>><?php echo esc_html( $val ); ?></option>
    <?php
	}
	echo '</select>';
	echo '<div><code>'. esc_html__( 'Select "yes" to create modified date sortable column in Admin > Posts screen.', 'wpflask-admin-columns' ) .'</code></div>';

}

/* Posts Thumbnail Column Callback */
function wpflask_ac_field_posts_thumbnail_column_cb() {

	// Available Options
	$items = wpflask_ac_select_bool_options();

	// Markup
	echo '<select id="posts_thumbnail_column" name="wpflask_ac_options[posts_thumbnail_column]">';
	foreach( $items as $key => $val ) {
	?>
    <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, wpflask_ac_option( 'posts_thumbnail_column' ) ); ?>><?php echo esc_html( $val ); ?></option>
    <?php
	}
	echo '</select>';
	echo '<div><code>'. esc_html__( 'Select "yes" to create post thumbnail column in Admin > Posts screen.', 'wpflask-admin-columns' ) .'</code></div>';

}

/**
 * Pages Section Callback
 */
function wpflask_ac_section_pages_cb() {
	echo '<div class="section-form-desc">
	  <p class="description">'. esc_html__( 'Configure pages columns by using the following settings.', 'wpflask-admin-columns' ) .'</p>
	</div>';
}

/* Pages Modified Column Callback */
function wpflask_ac_field_pages_modifed_column_cb() {

	// Available Options
	$items = wpflask_ac_select_bool_options();

	// Markup
	echo '<select id="pages_modifed_column" name="wpflask_ac_options[pages_modifed_column]">';
	foreach( $items as $key => $val ) {
	?>
    <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, wpflask_ac_option( 'pages_modifed_column' ) ); ?>><?php echo esc_html( $val ); ?></option>
    <?php
	}
	echo '</select>';
	echo '<div><code>'. esc_html__( 'Select "yes" to create modified date sortable column in Admin > Pages screen.', 'wpflask-admin-columns' ) .'</code></div>';

}

/* Pages Thumbnail Column Callback */
function wpflask_ac_field_pages_thumbnail_column_cb() {

	// Available Options
	$items = wpflask_ac_select_bool_options();

	// Markup
	echo '<select id="pages_thumbnail_column" name="wpflask_ac_options[pages_thumbnail_column]">';
	foreach( $items as $key => $val ) {
	?>
    <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, wpflask_ac_option( 'pages_thumbnail_column' ) ); ?>><?php echo esc_html( $val ); ?></option>
    <?php
	}
	echo '</select>';
	echo '<div><code>'. esc_html__( 'Select "yes" to create post thumbnail column in Admin > Pages screen.', 'wpflask-admin-columns' ) .'</code></div>';

}
