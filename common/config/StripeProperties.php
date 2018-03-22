<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\stripe\common\config;

// CMG Imports
use cmsgears\stripe\common\config\StripeGlobal;

use cmsgears\core\common\config\Properties;

/**
 * StripeProperties provide methods to access the properties specific to stripe.
 *
 * @since 1.0.0
 */
class StripeProperties extends Properties {

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

	private static $instance;

	// Constructor and Initialisation ------------------------------

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

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	// StripeProperties ----------------------

	/**
	 * Return the status among live or test.
	 *
	 * @return string
	 */
	public function getStatus() {

		return $this->properties[ self::PROP_STATUS ];
	}

	/**
	 * Check whether payments are enabled for Stripe.
	 *
	 * @return boolean
	 */
	public function isPayments() {

		return $this->properties[ self::PROP_PAYMENTS ];
	}

	/**
	 * Check whether status is set to either test or live.
	 *
	 * @return boolean
	 */
	public function isActive() {

		$status = $this->properties[ self::PROP_STATUS ];

		return strcmp( $status, 'test' ) == 0 || strcmp( $status, 'live' ) == 0;
	}

	/**
	 * Returns the currency configured for Stripe.
	 *
	 * @return string
	 */
	public function getCurrency() {

		return $this->properties[ self::PROP_CURRENCY ];
	}

	/**
	 * Returns the secret key for test mode.
	 *
	 * @return string
	 */
    public function getTestSecretKey() {

        return $this->properties[ self::PROP_TEST_SECRET_KEY ];
    }

	/**
	 * Returns the publishable key for test mode.
	 *
	 * @return string
	 */
    public function getTestPublishableKey() {

        return $this->properties[ self::PROP_TEST_PUBLISHABLE_KEY ];
    }

	/**
	 * Returns the secret key for live mode.
	 *
	 * @return string
	 */
    public function getLiveSecretKey() {

        return $this->properties[ self::PROP_LIVE_SECRET_KEY ];
    }

	/**
	 * Returns the publishable key for live mode.
	 *
	 * @return string
	 */
    public function getLivePublishableKey() {

        return $this->properties[ self::PROP_LIVE_PUBLISHABLE_KEY ];
    }

	/**
	 * Returns the publishable key according to the mode configured for stripe.
	 *
	 * @return string
	 */
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
