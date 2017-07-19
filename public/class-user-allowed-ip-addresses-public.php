<?php

/**
 * The public-facing functionality of the plugin.
 * @link       http://www.emoxie.com
 * @since      1.0.0
 * @package    User_Allowed_Ip_Addresses
 * @subpackage User_Allowed_Ip_Addresses/public
 */

class User_Allowed_Ip_Addresses_Public {

	/**
	 * The ID of this plugin.
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Function that looks up current users IP address and compares it to list of IP addresses allowed in User Record.
	 * @param $userName
	 */
	public function validate_user_ip($userName) {

		$user = get_user_by( 'login', $userName );
		$userIp = $this->get_the_user_ip();

		$allowedIps = get_user_meta($user->ID, 'ip_addresses',true);


		if($allowedIps) {

			$allowedIps = explode("\n", $allowedIps);


			if(!in_array($userIp, $allowedIps)){

				error_log('The IP Address ' . $userIp . ' is not in the allowed list of IPs for this user: ' . print_r($allowedIps,true));

				add_action('wp_logout', array($this,'redirect'));

				wp_logout();
			}

		}


	}

	public function redirect(){
		$no_access_url = get_option($this->plugin_name .'_no_access_url', true);

		if(!$no_access_url){
			$no_access_url = home_url();
		}

		wp_redirect( $no_access_url, 301 ); exit;
	}


	/**
	 * Helper function to get ip address of user
	 * @return mixed
	 */
	protected function get_the_user_ip() {
		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			//check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			//to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		return apply_filters( 'wpb_get_ip', $ip );
	}


}
