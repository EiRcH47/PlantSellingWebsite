<?php // phpcs:ignore WordPress.NamingConventions
/**
 * Frontend class
 *
 * @author  YITH
 * @package YITH\FrequentlyBoughtTogether
 * @version 1.0.0
 */

if ( ! defined( 'YITH_WFBT' ) ) {
	exit;
} // Exit if accessed directly.

if ( ! class_exists( 'YITH_WFBT_Frontend' ) ) {
	/**
	 * Frontend class.
	 * The class manage all the frontend behaviors.
	 *
	 * @since 1.0.0
	 */
	class YITH_WFBT_Frontend {

		/**
		 * Single instance of the class
		 *
		 * @since 1.0.0
		 * @var YITH_WFBT_Frontend
		 */
		protected static $instance;

		/**
		 * Plugin version
		 *
		 * @since 1.0.0
		 * @var string
		 */
		public $version = YITH_WFBT_VERSION;

		/**
		 * Returns single instance of the class
		 *
		 * @since 1.0.0
		 * @return YITH_WFBT_Frontend
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __construct() {
			// enqueue scripts.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'woocommerce_after_single_product_summary', array( $this, 'add_bought_together_form' ), 1 );
			add_shortcode( 'ywfbt_form', array( $this, 'wfbt_shortcode' ) );
		}

		/**
		 * Enqueue scripts
		 *
		 * @since  1.0.0
		 * @author Francesco Licandro <francesco.licandro@yithemes.com>
		 */
		public function enqueue_scripts() {

			wp_enqueue_style( 'yith-wfbt-style', YITH_WFBT_ASSETS_URL . '/css/yith-wfbt.css', array(), YITH_WFBT_VERSION );

			$background       = get_option( 'yith-wfbt-button-color' );
			$background_hover = get_option( 'yith-wfbt-button-color-hover' );
			$text_color       = get_option( 'yith-wfbt-button-text-color' );
			$text_color_hover = get_option( 'yith-wfbt-button-text-color-hover' );

			$inline_css = "
                .yith-wfbt-submit-block .yith-wfbt-submit-button {
                        background: {$background};
                        color: {$text_color};
                }
                .yith-wfbt-submit-block .yith-wfbt-submit-button:hover {
                        background: {$background_hover};
                        color: {$text_color_hover};
                }";

			wp_add_inline_style( 'yith-wfbt-style', $inline_css );
		}

		/**
		 * Form Template
		 *
		 * @since  1.0.0
		 * @author Francesco Licandro <francesco.licandro@yithemes.com>
		 */
		public function add_bought_together_form() {
			global $product;
			$product_id = yit_get_base_product_id( $product );
			echo do_shortcode( '[ywfbt_form product_id="' . $product_id . '"]' );
		}


		/**
		 * Frequently Bought Together Shortcode
		 *
		 * @since  1.0.5
		 * @author Francesco Licandro
		 * @param array $atts Shortcode attributes.
		 * @return string
		 */
		public function wfbt_shortcode( $atts ) {

			$atts = shortcode_atts(
				array(
					'product_id' => 0,
				),
				$atts
			);

			extract( $atts ); //phpcs:ignore WordPress.PHP.DontExtract

			$product_id = intval( $product_id );
			$product    = wc_get_product( $product_id );

			if ( ! $product ) {
				// get global.
				global $product;
			}

			// if also global is empty return.
			if ( ! $product ) {
				return '';
			}

			// get meta for current product.
			$group = $product->get_meta( YITH_WFBT_META, true );
			if ( empty( $group ) || $product->is_type( array( 'grouped', 'external' ) ) ) {
				return '';
			}

			if ( $product->is_type( 'variable' ) ) {

				$variations = $product->get_children();

				if ( empty( $variations ) ) {
					return '';
				}
				// get first product variation.
				$product_id = array_shift( $variations );
				$product    = wc_get_product( $product_id );
			}

			$products[] = $product;
			foreach ( $group as $the_id ) {
				$current = wc_get_product( $the_id );
				if ( ! $current || ! $current->is_purchasable() || ! $current->is_in_stock() ) {
					continue;
				}
				// add to main array.
				$products[] = $current;
			}

			ob_start();

			wc_get_template( 'yith-wfbt-form.php', array( 'products' => $products ), '', YITH_WFBT_DIR . 'templates/' );

			return ob_get_clean();
		}
	}
}
/**
 * Unique access to instance of YITH_WFBT_Frontend class
 *
 * @since 1.0.0
 * @return YITH_WFBT_Frontend
 */
function YITH_WFBT_Frontend() { // phpcs:ignore WordPress.NamingConventions
	return YITH_WFBT_Frontend::get_instance();
}
