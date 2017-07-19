<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.emoxie.com
 * @since      1.0.0
 *
 * @package    User_Allowed_Ip_Addresses
 * @subpackage User_Allowed_Ip_Addresses/admin
 */

class User_Allowed_Ip_Addresses_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	public function register ( ){
		register_setting($this->plugin_name . '_options', $this->plugin_name .'_no_access_url');

	}

	public function menu() {
		add_options_page('User Allowed IP Addresses Plugin Options', 'User Allowed IP Addresses', 'manage_options', $this->plugin_name . '_options', array($this, 'options_page'));
	}


	public function options_page() {
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}

		$plugin_id = $this->plugin_name;
		$no_access_url = get_option($this->plugin_name .'_no_access_url');

		require_once dirname(__FILE__) . '/tpl/options.php';
	}



	/**
	 * Function to add the IP addresses field to user record
	 * @param $user
	 */
	public function extra_user_profile_fields( $user ) {
		?>
		<h3><?php _e("Allowed IP Addresses", "blank"); ?></h3>
		<table class="form-table">
			<tr>
				<th><label for="ip_addresses"><?php _e("IP Addresses"); ?></label></th>
				<td>
					<textarea name="ip_addresses" id="ip_addresses" class="regular-text"><?php echo esc_attr( get_the_author_meta( 'ip_addresses', $user->ID ) ); ?></textarea>
					<br>
					<span class="description"><?php _e("To allow all IP addresses leave Blank/Empty.  Otherwise, add 1 IP address per line."); ?></span>
				</td>
			</tr>
		</table>
		<?php
	}


	/**
	 * Function to save the ip addresses inputted in user record
	 * @param $user_id
	 *
	 * @return bool
	 */
	public function save_extra_user_profile_fields( $user_id ) {
		$saved = false;
		if ( current_user_can( 'edit_user', $user_id ) ) {
			update_user_meta( $user_id, 'ip_addresses', $_POST['ip_addresses'] );
			$saved = true;
		}
		return true;
	}


}
