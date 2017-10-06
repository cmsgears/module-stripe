<?php
namespace cmsgears\stripe\common\services\system;

// Stripe Imports
use Stripe\Stripe;
use Stripe\Charge;

// CMG Imports
use cmsgears\stripe\common\config\StripeProperties;

use cmsgears\stripe\common\services\interfaces\system\IStripeService;

class StripeService extends \yii\base\Component implements IStripeService {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	public static $modelClass	= '\cmsgears\stripe\common\models\entities\Transaction';

	// Protected --------------

	// Variables -----------------------------

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

	// Yii parent classes --------------------

	// yii\base\Component -----

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	// StripeService -------------------------

	// Data Provider ------

	// Read ---------------

	// Read - Models ---

	// Read - Lists ----

	// Read - Maps -----

	// Read - Others ---

	// Create -------------

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

	// Update -------------

	// Delete -------------

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

	// Static Methods ----------------------------------------------

	// CMG parent classes --------------------

	// StripeService -------------------------

	// Data Provider ------

	// Read ---------------

	// Read - Models ---

	// Read - Lists ----

	// Read - Maps -----

	// Read - Others ---

	// Create -------------

	// Update -------------

	// Delete -------------

}
