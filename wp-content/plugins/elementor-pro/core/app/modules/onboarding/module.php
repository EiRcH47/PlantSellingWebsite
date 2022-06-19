<?php
namespace ElementorPro\Core\App\Modules\Onboarding;

use Elementor\Core\App\Modules\Onboarding\Module as Core_Onboarding_Module;
use ElementorPro\Plugin;
use Elementor\Core\Base\Module as BaseModule;
use ElementorPro\Core\Connect\Apps\Activate;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Module extends BaseModule {

	/**
	 * Get name
	 *
	 * @since 3.6.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_name() {
		return 'onboarding';
	}

	/**
	 * Set Onboarding Settings
	 *
	 * Overrides the Onboarding App's Core settings with updated settings to accommodate for Elementor Pro.
	 *
	 * @since 3.6.0
	 * @access private
	 */
	private function set_onboarding_settings() {
		return;
	}

	public function __construct() {
		add_action( 'elementor/init', function () {
			$this->set_onboarding_settings();
		}, 13 /** after elementor core */ );
	}
}
