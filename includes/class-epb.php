<?php

class Epb {

	protected $loader;
	protected $epb;
	protected $version;

	public function __construct() {
		if ( defined( 'EPB_VERSION' ) ) {
			$this->version = EPB_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->epb = 'epb';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_common_hooks();
	}

	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-epb-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-epb-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-epb-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-epb-public.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'common/class-epb-common.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/vendor/autoload.php';

		$this->loader = new Epb_Loader();

	}

	private function set_locale() {
		$plugin_i18n = new Epb_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}


	private function define_admin_hooks() {
		$plugin_admin = new Epb_Admin( $this->get_epb(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	}

	private function define_public_hooks() {
		$plugin_public = new Epb_Public( $this->get_epb(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'woocommerce_before_add_to_cart_form', $plugin_public, 'beforeAddToCartForm' );
		$this->loader->add_shortcode( 'epb_paypal', $plugin_public, 'epbPaypalButton' );
		$this->loader->add_action( 'wp_head', $plugin_public, 'modifyHeader' );

	}

	private function define_common_hooks() {
		$plugin_common = new Epb_Common( $this->get_epb(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_common, 'enqueue_styles', 1 );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_common, 'enqueue_scripts', 1 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_common, 'enqueue_styles', 1 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_common, 'enqueue_scripts', 1 );
		$this->loader->add_shortcode( 'test_shortcode', $plugin_common, 'test_shortcode' );
	}

	public function run() {
		$this->loader->run();
	}

	public function get_epb() {
		return $this->epb;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
