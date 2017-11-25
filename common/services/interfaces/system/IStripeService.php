<?php
namespace cmsgears\stripe\common\services\interfaces\system;

interface IStripeService {

	// Data Provider ------

	// Read ---------------

	// Read - Models ---

	// Read - Lists ----

	// Read - Maps -----

	// Create -------------

	public function createPayment( $order, $token );
	public function refundPayment( $order );

	// Update -------------

	// Delete -------------

}
