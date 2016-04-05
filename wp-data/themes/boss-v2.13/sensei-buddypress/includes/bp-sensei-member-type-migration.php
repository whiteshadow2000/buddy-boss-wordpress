<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Migration Class
 *
 * Handles users member type migration.
 * @author      BuddyBoss
 */
class BuddyPress_Sensei_Member_Type_Migration {

	/** @var BuddyPress_Sensei_Member_Type_Migration The single instance of the class */
	protected static $_instance = null;

	//initialization
	function __construct() {

		add_action( 'admin_enqueue_scripts',                   array( &$this, 'admin_enqueues' ) );
		add_action( 'wp_ajax_migrate_member_type',             array( &$this, 'ajax_migrate_member_type' ) );
	}

	/**
	 * Main BuddyPress_Sensei_Member_Type_Migration Instance
	 *
	 * Ensures only one instance of BuddyPress_Sensei_Member_Type_Migration is loaded or can be loaded.
	 *
	 * @static
	 * @return BuddyPress_Sensei_Member_Type_Migration Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Enqueue the needed Javascript and CSS
	 * @param $hook_suffix
	 */
	function admin_enqueues( $hook_suffix ) {

		// WordPress 3.1 vs older version compatibility
		if ( wp_script_is( 'jquery-ui-widget', 'registered' ) )
			wp_enqueue_script( 'jquery-ui-progressbar', BUDDYPRESS_SENSEI_PLUGIN_URL .'assets/jquery-ui/jquery.ui.progressbar.min.js', array( 'jquery-ui-core', 'jquery-ui-widget' ), '1.8.6' );
		else
			wp_enqueue_script( 'jquery-ui-progressbar',  BUDDYPRESS_SENSEI_PLUGIN_URL .'assets/jquery-ui/jquery.ui.progressbar.min.1.7.2.js', array( 'jquery-ui-core' ), '1.7.2' );

		wp_enqueue_style( 'jquery-ui-users-migration', BUDDYPRESS_SENSEI_PLUGIN_URL .'assets/jquery-ui/redmond/jquery-ui-1.7.2.custom.css', array(), '1.7.2' );
	}

	/**
	 * The user interface plus user migration
	 */
	function migrate_interface() {
		global $wpdb;

		$user_data_migrate_ids  = array();

		$value                  = buddypress_sensei()->option( 'convert_subscribers' );

		if ( $value ) {
			$query                  = $this->convert_users_to_bp_member_type_query( 'subscriber', 'student' );
			$user_data_migrate_ids  = array_merge( $user_data_migrate_ids, $wpdb->get_col( $query ) );
		} else {
			$query                  = $this->remove_convertion_users_to_bp_member_type_query( 'subscriber', 'student' );
			$user_data_migrate_ids  = array_merge( $user_data_migrate_ids, $wpdb->get_col( $query ) );
		}


		$value = buddypress_sensei()->option( 'convert_teachers' );

		if ( $value ) {

			$query                  = $this->convert_users_to_bp_member_type_query( 'teacher', 'teacher' );
			$user_data_migrate_ids  = array_merge( $user_data_migrate_ids, $wpdb->get_col( $query ) );
		} else {

			$query                  = $this->remove_convertion_users_to_bp_member_type_query( 'teacher', 'teacher' );
			$user_data_migrate_ids  = array_merge( $user_data_migrate_ids, $wpdb->get_col( $query ) );
		}


		if ( ! empty( $user_data_migrate_ids ) ) {

			$users  = array_map( 'intval',  $user_data_migrate_ids  );
			$ids    = implode( ',', $users );

		} else {
			return;
		}

		?>

		<div id="message" class="updated fade" style="display:none"></div>

		<div class="users-migration">

			<h2 class="progress-title" style="float: left;"><?php  _e( 'Migrating, please wait...', 'sensei-buddypress' ) ?></h2>
			<img src="/wp-admin/images/spinner.gif" alt="" class="migration-progress-ajax-spinner general-spinner" style="display: none; float: left; top: 15px; position: relative; left: 7px;">

			<?php
				echo '	<p style="clear: both;">' . __( "Please be patient while the migration. This can take a while if your server is slow (inexpensive hosting) or if you have many records. Do not navigate away from this page until this script is done or the records will not be migrated. You will be notified via this page when the migration is completed.", 'sensei-buddypress' ) . '</p> <br/>';

				$count = count( $user_data_migrate_ids );

				$text_goback = ( ! empty( $_GET['goback'] ) ) ? sprintf( __( 'To go back to the previous page, <a href="%s">click here</a>.', 'sensei-buddypess' ), 'javascript:history.go(-1)' ) : '';
				$text_failures = sprintf( __( 'All done! %1$s user(s) were successfully migrated in %2$s seconds and there were %3$s failure(s). To try migration the failed users again, <a href="%4$s">click here</a>. %5$s', 'sensei-buddypess' ), "' + bps_successes + '", "' + bps_totaltime + '", "' + bps_errors + '", esc_url( wp_nonce_url( admin_url( 'tools.php?page=sensei-buddypess&goback=1' ), 'sensei-buddypess' ) . '&ids=' ) . "' + bps_failedlist + '", $text_goback );
				$text_nofailures = sprintf( __( 'All done! %1$s user(s) were successfully migrated in %2$s seconds and there were 0 failures. %3$s', 'sensei-buddypess' ), "' + bps_successes + '", "' + bps_totaltime + '", $text_goback );
				?>


				<noscript><p><em><?php _e( 'You must enable Javascript in order to proceed!', 'sensei-buddypess' ) ?></em></p></noscript>

				<div id="users-migration-bar" style="position:relative;height:25px;">
					<div id="users-migration-bar-percent" style="position:absolute;left:50%;top:50%;width:300px;margin-left:-150px;height:25px;margin-top:-9px;font-weight:bold;text-align:center;"></div>
				</div>

				<p>
					<input type="button" class="button hide-if-no-js" name="users-migration-" id="users-migration-stop" value="<?php _e( 'Abort Migration', 'sensei-buddypess' ) ?>" />
				</p>

				<h3 class="title"><?php _e( 'Migration Information', 'sensei-buddypress' ) ?></h3>

				<p>
					<?php printf( __( 'Total Users: %s', 'sensei-buddypress' ), $count ); ?><br />
					<?php printf( __( 'Users Migrated: %s', 'sensei-buddypress' ), '<span id="users-migration-debug-successcount">0</span>' ); ?><br />
					<?php printf( __( 'User Migration Failures: %s', 'sensei-buudypress' ), '<span id="users-migration-debug-failurecount">0</span>' ); ?>
				</p>
			

				<script type="text/javascript">
					// <![CDATA[
					jQuery(document).ready(function($){
						var i;
						var bps_users = [<?php echo $ids; ?>];
						var bps_total = bps_users.length;
						var bps_count = 0;
						var bps_successes = 0;
						var bps_errors = 0;
						var bps_failedlist = '';
						var bps_resulttext = '';
						var bps_timestart = new Date().getTime();
						var bps_timeend = 0;
						var bps_totaltime = 0;
						var bps_continue = true;


						// Create the progress bar
						$("#users-migration-bar").progressbar();
						$("#users-migration-bar-percent").html( "0%" );
						var $ajax_spinner = $('img.migration-progress-ajax-spinner');

						// Stop button
						$("#users-migration-stop").click(function() {
							bps_continue = false;
							$('#users-migration-stop').val("<?php echo $this->esc_quotes( __( 'Stopping...', 'sensei-buddypress' ) ); ?>");
						});

						// Called after each resize. Updates debug information and the progress bar.
						function UsersMigrationUpdateStatus( success, response ) {
							bps_count = bps_count + response.total_migrated_users;
							$("#users-migration-bar").progressbar( "value", ( bps_count / bps_total ) * 100 );
							$("#users-migration-bar-percent").html( Math.round( ( bps_count / bps_total ) * 1000 ) / 10 + "%" );

							if ( success ) {
								bps_successes = response.total_migrated_users + bps_successes;
								$("#users-migration-debug-successcount").html(bps_successes);
							}
							else {
								bps_errors = bps_errors + response.total_migrated_users;
								$("#users-migration-debug-failurecount").html(bps_errors);
							}
						}

						// Called when all users have been processed. Shows the results and cleans up.
						function UsersMigrationFinishUp() {
							bps_timeend = new Date().getTime();
							bps_totaltime = Math.round( ( bps_timeend - bps_timestart ) / 1000 );

							$('#users-migration-stop').hide();

							if ( bps_errors > 0 ) {
								bps_resulttext = '<?php echo $text_failures; ?>';
							} else {
								bps_resulttext = '<?php echo $text_nofailures; ?>';
							}

							$("#message").html("<p><strong>" + bps_resulttext + "</strong></p>");
							$("#message").show();
							$ajax_spinner.hide();
						}

						// Migrate a specified batch via AJAX
						function UsersMigration( ) {

							$.ajax({
								type: 'POST',
								url: ajaxurl,
								data: { action: "migrate_member_type" },
								success: function( response ) {
									if ( response !== Object( response ) || ( typeof response.success === "undefined" && typeof response.error === "undefined" ) ) {
										response = new Object;
										response.success = false;
										response.error = "<?php printf( esc_js( __( 'The migrate request was abnormally terminated (ID %s). This is likely due to the user exceeding available memory or some other type of fatal error.', 'sensei-buddypess' ) ), '" + id + "' ); ?>";
									}

									if ( response.success ) {
										UsersMigrationUpdateStatus( true, response );
									}
									else {
										UsersMigrationUpdateStatus( false, response );
									}

									if ( bps_count < bps_users.length && bps_continue ) {
										UsersMigration();
									}
									else {
										UsersMigrationFinishUp();
									}


								},
								error: function( response ) {
									UsersMigrationUpdateStatus( false, response );

									if ( bps_count < bps_users.length && bps_continue ) {
										UsersMigration();
									}
									else {
										UsersMigrationFinishUp();
									}


								}
							});
						}

						$ajax_spinner.show();
						UsersMigration();
					});
					// ]]>
				</script>

		</div>

		<?php
	}

	/**
	 *  Process a single users batch
	 */
	function ajax_migrate_member_type() {

		@error_reporting( 0 ); // Don't break the JSON result

		header( 'Content-type: application/json' );

		$migrated_users_cnt = 0;

		@set_time_limit( 900 ); // 5 minutes per batch of 100-100 should be PLENTY

		$value = buddypress_sensei()->option( 'convert_subscribers' );
		if ( $value ) {
			$migrated_users_cnt += $this->convert_users_to_bp_member_type( 'subscriber', 'student' );
		} else {
			$migrated_users_cnt += $this->remove_convertion_users_to_bp_member_type( 'subscriber', 'student' );
		}

		$value = buddypress_sensei()->option( 'convert_teachers' );
		if ( $value ) {
			$migrated_users_cnt += $this->convert_users_to_bp_member_type( 'teacher', 'teacher' );
		} else {
			$migrated_users_cnt += $this->remove_convertion_users_to_bp_member_type( 'teacher', 'teacher' );
		}


		die( json_encode( array( 'success' => true, 'total_migrated_users' => $migrated_users_cnt ) ) );
	}


	// Helper to make a JSON error message
	function die_json_error_msg( $id, $message ) {
		die( json_encode( array( 'error' => sprintf( __( '&quot;%1$s&quot; (ID %2$s) failed to resize. The error message was: %3$s', 'sensei-buddypess' ), esc_html( get_the_title( $id ) ), $id, $message ) ) ) );
	}


	// Helper function to escape quotes in strings for use in Javascript
	function esc_quotes( $string ) {
		return str_replace( '"', '\"', $string );
	}

	/**
	 * Set users members type when Convert user role is checked
	 * @param $role
	 * @param $bp_member_type
	 * @return int
	 */
	public function convert_users_to_bp_member_type( $role, $bp_member_type ) {
		global $wpdb;

		$query              = $this->convert_users_to_bp_member_type_query( $role, $bp_member_type, 'LIMIT 100' );
		$all_users          = $wpdb->get_col( $query );
		$migrated_users_cnt = 0;

		foreach ( $all_users as $user ) {

			// Set type for a member.
			$retval = bp_set_member_type( $user, $bp_member_type );

			if ( ! empty( $retval ) ) {
				$migrated_users_cnt++;
			}
		}

		return $migrated_users_cnt;
	}

	/**
	 * Remove users member type when Convert user role is unchecked
	 * @param $role
	 * @param $bp_member_type
	 * @return int
	 */
	public function remove_convertion_users_to_bp_member_type( $role, $bp_member_type ) {
		global $wpdb;

		$query              = $this->remove_convertion_users_to_bp_member_type_query( $role, $bp_member_type, 'LIMIT 100' );
		$all_users          = $wpdb->get_col( $query );
		$migrated_users_cnt = 0;

		foreach ( $all_users as $user ) {

			//Remove type for a member.
			$retval = bp_remove_member_type( $user, $bp_member_type );

			if ( ! empty( $retval ) ) {
				$migrated_users_cnt++;
			}
		}

		return $migrated_users_cnt;
	}


	/**
	 * Return the all users id need to be converted
	 * @param $role
	 * @param $bp_member_type
	 * @param string $limit_query
	 * @return string
	 */
	public function convert_users_to_bp_member_type_query( $role, $bp_member_type, $limit_query = '' ) {
		global $wpdb;

		return "SELECT DISTINCT u.user_id FROM  {$wpdb->usermeta} AS u LEFT JOIN {$wpdb->term_relationships} AS tr ON tr.object_id = u.user_id
LEFT JOIN {$wpdb->term_taxonomy} AS tt ON tt.term_taxonomy_id = tr.term_taxonomy_id LEFT JOIN {$wpdb->terms} AS t ON t.term_id = tt.term_id
WHERE meta_key LIKE 'wp_capabilities' AND meta_value LIKE '%{$role}%'   AND ( ( tt.taxonomy = 'bp_member_type' AND t.slug != '{$bp_member_type}' ) OR tr.object_id IS NULL ) ".$limit_query;

	}

	/**
	 * Return all users ids needed to be remove their member types
	 * @param $role
	 * @param $bp_member_type
	 * @param string $limit_query
	 * @return string
	 */
	public function remove_convertion_users_to_bp_member_type_query( $role, $bp_member_type, $limit_query = '' ) {
		global $wpdb;

		return "SELECT DISTINCT u.user_id FROM  {$wpdb->usermeta} AS u LEFT JOIN {$wpdb->term_relationships} AS tr ON tr.object_id = u.user_id
LEFT JOIN {$wpdb->term_taxonomy} AS tt ON tt.term_taxonomy_id = tr.term_taxonomy_id LEFT JOIN {$wpdb->terms} AS t ON t.term_id = tt.term_id
WHERE meta_key LIKE 'wp_capabilities' AND meta_value LIKE '%{$role}%'   AND ( ( tt.taxonomy = 'bp_member_type' AND t.slug = '{$bp_member_type}' ) ) ".$limit_query;
	}

}

global $bp_sensei_member_type_migration;
$bp_sensei_member_type_migration = BuddyPress_Sensei_Member_Type_Migration::instance();

?>