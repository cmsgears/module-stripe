<?php
namespace cmsgears\stripe\common\config;

// Yii Imports
use \Yii;

// CMG Imports
use cmsgears\stripe\common\config\StripeGlobal;

class StripeProperties extends \cmsgears\core\common\config\CmgProperties {

	const PROP_STATUS                   = 'status';
    const PROP_TEST_SECRET_KEY          = 'test secret key';
    const PROP_TEST_PUBLISHABLE_KEY     = 'test publishable key';
    const PROP_LIVE_SECRET_KEY          = 'live scret key';
    const PROP_LIVE_PUBLISHABLE_KEY     = 'live publishable key';
    const PROP_CURRENCY                 = 'currency';

	// Singleton instance
	private static $instance;

	// Constructor and Initialisation ------------------------------

	private function __construct() {

		// init code
	}

	/**
	 * Return Singleton instance.
	 */
	public static function getInstance() {

		if( !isset( self::$instance ) ) {

			self::$instance	= new StripeProperties();

			self::$instance->init( StripeGlobal::CONFIG_STRIPE );
		}

		return self::$instance;
	}

	/**
	 * Return rest property for the specified key.
	 */
	public function getProperty( $key ) {

		return $this->properties[ key ];
	}

	public function getStatus() {

		return $this->properties[ self::PROP_STATUS ];
	}

	public function isActive() {

		$status = $this->properties[ self::PROP_STATUS ];

		return strcmp( $status, 'test' ) == 0 || strcmp( $status, 'live' ) == 0;
	}

	public function getCurrency() {

		return $this->properties[ self::PROP_CURRENCY ];
	}

    public function getTestSecretKey() {

        return $this->properties[ self::PROP_TEST_SECRET_KEY ];
    }

    public function getTestPublishableKey() {

        return $this->properties[ self::PROP_TEST_PUBLISHABLE_KEY ];
    }

    public function getLiveSecretKey() {

        return $this->properties[ self::PROP_LIVE_SECRET_KEY ];
    }

    public function getLivePublishableKey() {

        return $this->properties[ self::PROP_LIVE_PUBLISHABLE_KEY ];
    }
}

?>