<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\stripe\common\components;

// Yii Imports
use Yii;
use yii\base\Component;

/**
 * Stripe component register the services provided by Stripe Module.
 *
 * @since 1.0.0
 */
class Stripe extends Component {

	// Global -----------------

	// Public -----------------

	// Protected --------------

	// Private ----------------

	// Constructor and Initialisation ------------------------------

	/**
	 * Initialize the services.
	 */
	public function init() {

		parent::init();

		// Register components and objects
		$this->registerComponents();
	}

	// Instance methods --------------------------------------------

	// Yii parent classes --------------------

	// CMG parent classes --------------------

	// Stripe --------------------------------

	// Properties

	// Components and Objects

	/**
	 * Register the services.
	 */
	public function registerComponents() {

		// Register services
		$this->registerResourceServices();
		$this->registerSystemServices();

		// Init services
		$this->initResourceServices();
		$this->initSystemServices();
	}

	/**
	 * Registers resource services.
	 */
	public function registerResourceServices() {

		$factory = Yii::$app->factory->getContainer();

		$factory->set( 'cmsgears\stripe\common\services\interfaces\resources\ITransactionService', 'cmsgears\stripe\common\services\resources\TransactionService' );
	}

	/**
	 * Registers system services.
	 */
	public function registerSystemServices() {

		$factory = Yii::$app->factory->getContainer();

		$factory->set( 'cmsgears\stripe\common\services\interfaces\system\IStripeService', 'cmsgears\stripe\common\services\system\StripeService' );
	}

	/**
	 * Initialize resource services.
	 */
	public function initResourceServices() {

		$factory = Yii::$app->factory->getContainer();

		$factory->set( 'stripeTransactionService', 'cmsgears\stripe\common\services\resources\TransactionService' );
	}

	/**
	 * Initialize system services.
	 */
	public function initSystemServices() {

		$factory = Yii::$app->factory->getContainer();

		$factory->set( 'stripeService', 'cmsgears\stripe\common\services\system\StripeService' );
	}

}
