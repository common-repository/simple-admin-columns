<div class="wrap wpflask-ac-admin-wrapper">
	<h1><?php printf( '%1$s', esc_html__( 'Simple Admin Columns Settings', 'wpflask-admin-columns' ) ); ?></h1>

	<div class="settings-container">
		<div class="settings-col settings-col-options">
			<div class="options-wrapper">

				<form action="options.php" method="post" class="form-options-wrapper">

					<?php settings_fields( 'wpflask_ac_options_group' ); ?>

					<h2 class="nav-tab-wrapper">
						<a class="nav-tab nav-tab-active" id="postscolumns-tab" href="#top#postscolumns"><?php esc_html_e( 'Posts Columns', 'wpflask-admin-columns' ); ?></a>
						<a class="nav-tab" id="pagescolumns-tab" href="#top#pagescolumns"><?php esc_html_e( 'Pages Columns', 'wpflask-admin-columns' ); ?></a>
					</h2>

					<section id="postscolumns" class="nav-tab-section">
						<?php do_settings_sections( 'wpflask_ac_section_posts_page' ); ?>
					</section>

					<section id="pagescolumns" class="nav-tab-section">
						<?php do_settings_sections( 'wpflask_ac_section_pages_page' ); ?>
					</section>

					<input type="submit" class="button button-primary" value="<?php esc_html_e( 'Save Changes', 'wpflask-admin-columns' ); ?>">
				</form>

			</div><!-- .options-wrapper -->
		</div><!-- .settings-col -->

		<div class="settings-col settings-col-info">
			<div class="info-wrapper">

					<div class="card-wrapper">
						<div class="card-wrapper-inside">
							<h2 class="title"><?php esc_html_e( 'Our Projects', 'wpflask-admin-columns' ); ?></h2>
								<p>
									<a href="https://wpflask.com/radical/?utm_source=wporg-admin-columns&utm_medium=button&utm_campaign=wporg" class="button button-primary" target="_blank"><?php echo esc_html__( 'Radical - Free WordPress Theme', 'wpflask-admin-columns' ); ?></a>
								</p>
						</div>
					</div>

					<div class="card-wrapper">
						<div class="card-wrapper-inside">
							<h2 class="title"><?php esc_html_e( 'Rate the Plugin', 'wpflask-admin-columns' ); ?></h2>
								<?php
									printf( '<p>%1$s</p> <p><a href="%2$s" target="_blank">%3$s</a></p>',
										esc_html__( 'Do you like the plugin?', 'wpflask-admin-columns' ),
										esc_url( 'https://wordpress.org/support/plugin/simple-admin-columns/reviews/' ),
										esc_html__( 'Please rate it at wordpress.org!', 'wpflask-admin-columns' )
									);
								?>
						</div>
					</div>

					<div class="card-wrapper">
						<div class="card-wrapper-inside">
							<h2 class="title"><?php esc_html_e( 'Follow Us', 'wpflask-admin-columns' ); ?></h2>
								<p>
									<a href="https://www.facebook.com/wpflask/" class="button" target="_blank"><?php echo esc_html__( 'Like Us On Facebook', 'wpflask-admin-columns' ); ?></a>
								</p>
								<p>
									<a href="https://twitter.com/wpflask" class="button" target="_blank"><?php echo esc_html__( 'Follow On Twitter', 'wpflask-admin-columns' ); ?></a>
								</p>
						</div>
					</div>

			</div><!-- .info-wrapper -->
		</div><!-- .settings-col -->
	</div><!-- .settings-container -->

</div><!-- .wpflask-ac-admin-wrapper -->
