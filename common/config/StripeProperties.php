<?php
namespace cmsgears\stripe\common\config;

// CMG Imports
use cmsgears\stripe\common\config\StripeGlobal;

class StripeProperties extends \cmsgears\core\common\config\CmgProperties {

	// Variables ---------------------------------------------------

	// Global -----------------

	const PROP_STATUS                   = 'status';
	const PROP_PAYMENTS					= 'payments';
	const PROP_CURRENCY                 = 'currency';

    const PROP_TEST_SECRET_KEY          = 'test_secret_key';
    const PROP_TEST_PUBLISHABLE_KEY     = 'test_publishable_key';

    const PROP_LIVE_SECRET_KEY          = 'live_secret_key';
    const PROP_LIVE_PUBLISHABLE_KEY     = 'live_publishable_key';

	// Public -----------------

	// Protected --------------

	// Private ----------------

	// Singleton instance
	private static $instance;

	// Constructor and Initialisation ------------------------------

	// Instance methods --------------------------------------------

	// Yii parent classes --------------------

	// CMG parent classes --------------------

	// PaypalRestProperties ------------------

	// Singleton

	public static function getInstance() {

		if( !isset( self::$instance ) ) {

			self::$instance	= new StripeProperties();

			self::$instance->init( StripeGlobal::CONFIG_STRIPE );
		}

		return self::$instance;
	}

	// Properties

	public function getStatus() {

		return $this->properties[ self::PROP_STATUS ];
	}

	public function isPayments() {

		return $this->properties[ self::PROP_PAYMENTS ];
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

	public function getPublishableKey() {

		switch( $this->properties[ self::PROP_STATUS ] ) {

			case 'test': {

				return $this->properties[ self::PROP_TEST_PUBLISHABLE_KEY ];
			}
			case 'live': {

				return $this->properties[ self::PROP_LIVE_PUBLISHABLE_KEY ];
			}
		}
	}
}
