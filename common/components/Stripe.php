<?php
namespace cmsgears\stripe\common\components;

// Yii Imports
use Yii;

class Stripe extends \yii\base\Component {

	// Global -----------------

	// Public -----------------

	// Protected --------------

	// Private ----------------

	// Constructor and Initialisation ------------------------------

	/**
	 * Initialise the CMG Core Component.
	 */
	public function init() {

		parent::init();

		// Register application components and objects i.e. CMG and Project
		$this->registerComponents();
	}

	// Instance methods --------------------------------------------

	// Yii parent classes --------------------

	// CMG parent classes --------------------

	// Stripe --------------------------------

	// Properties

	// Components and Objects

	public function registerComponents() {

		// Register services
		$this->registerEntityServices();
		$this->registerSystemServices();

		// Init services
		$this->initEntityServices();
		$this->initSystemServices();
	}

	public function registerEntityServices() {

		$factory = Yii::$app->factory->getContainer();

		$factory->set( 'cmsgears\stripe\common\services\interfaces\entities\ITransactionService', 'cmsgears\stripe\common\services\entities\TransactionService' );
	}

	public function registerSystemServices() {

		$factory = Yii::$app->factory->getContainer();

		$factory->set( 'cmsgears\stripe\common\services\interfaces\system\IStripeService', 'cmsgears\stripe\common\services\system\StripeService' );
	}

	public function initEntityServices() {

		$factory = Yii::$app->factory->getContainer();

		$factory->set( 'stripeTransactionService', 'cmsgears\stripe\common\services\entities\TransactionService' );
	}

	public function initSystemServices() {

		$factory = Yii::$app->factory->getContainer();

		$factory->set( 'stripeService', 'cmsgears\stripe\common\services\system\StripeService' );
	}
}
