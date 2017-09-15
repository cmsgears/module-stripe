<?php
namespace cmsgears\stripe\common\services\entities;

// CMG Imports
use cmsgears\stripe\common\models\entities\Transaction;

use cmsgears\stripe\common\services\interfaces\entities\ITransactionService;

class TransactionService extends \cmsgears\cart\common\services\entities\TransactionService implements ITransactionService {

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

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	// Instance methods --------------------------------------------

	// Yii parent classes --------------------

	// yii\base\Component -----

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	// TransactionService --------------------

	// Data Provider ------

	// Read ---------------

	// Read - Models ---

	public function getByCode( $code ) {

		return Transaction::findByCodeService( $code, Transaction::SERVICE_STRIPE );
	}

	// Read - Lists ----

	// Read - Maps -----

	// Read - Others ---

	// Create -------------

	// Update -------------

	// Delete -------------

	// Static Methods ----------------------------------------------

	// CMG parent classes --------------------

	// TransactionService --------------------

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
