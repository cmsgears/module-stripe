<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\stripe\common\services\system;

// Stripe Imports
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Refund;

// CMG Imports
use cmsgears\stripe\common\config\StripeProperties;

use cmsgears\stripe\common\services\interfaces\system\IStripeService;

use cmsgears\core\common\services\base\SystemService;

/**
 * StripeService provide methods specific to Stripe APIs to handle transactions.
 *
 * @since 1.0.0
 */
class StripeService extends SystemService implements IStripeService {

	// Variables ---------------------------------------------------

	// Globals ----------------

	// Public -----------------

	// Protected --------------

	// Private ----------------

	private $properties;

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	public function __construct( $config = [] ) {

		$this->properties = StripeProperties::getInstance();

		parent::__construct( $config );
	}

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	// StripeService -------------------------

    public function createPayment( $order, $token ) {

		$this->initStripe();

		$charge	= Charge::create([
			'amount'   => $order->grandTotal * 100,
			'currency' => $this->properties->getCurrency(),
			'description' => $order->description,
			'source' => $token
		]);

		return $charge;
    }


	public function refundPayment( $order ) {

		$this->initStripe();

		$transaction = $order->getTransaction()->one();
		$data		= json_decode( $transaction->data );
		$paymentId	=  $data->paymentId;

		$charge	= Refund::create([
			'charge'   => $paymentId
		]);

		return $charge;
    }

	// SDK Configuration --

	private function initStripe() {

		$stripeConfig = [];

		if( strcmp( $this->properties->getStatus(), 'test' ) == 0 ) {

			$stripeConfig[ 'secret_key' ]		= $this->properties->getTestSecretKey();
			$stripeConfig[ 'publishable_key' ]	= $this->properties->getTestPublishableKey();
		}
		else if( strcmp( $this->properties->getStatus(), 'live' ) == 0 ) {

			$stripeConfig[ 'secret_key' ]		= $this->properties->getLiveSecretKey();
			$stripeConfig[ 'publishable_key' ]	= $this->properties->getLivePublishableKey();
		}

		Stripe::setApiKey( $stripeConfig[ 'secret_key' ] );
	}

}
