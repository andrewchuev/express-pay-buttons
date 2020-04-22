<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://reslab.tech
 * @since      1.0.0
 *
 * @package    Epb
 * @subpackage Epb/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Epb
 * @subpackage Epb/admin
 * @author     Andrew A. Chuev <andrew.chuev@gmail.com>
 */
class Epb_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $epb    The ID of this plugin.
	 */
	private $epb;

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
	 * @param      string    $epb       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $epb, $version ) {

		$this->epb = $epb;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Epb_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Epb_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->epb, plugin_dir_url( __FILE__ ) . 'css/epb-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Epb_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Epb_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->epb, plugin_dir_url( __FILE__ ) . 'js/epb-admin.js', array( 'jquery' ), $this->version, false );

	}

}
