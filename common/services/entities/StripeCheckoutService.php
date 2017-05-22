<?php
namespace cmsgears\stripe\common\services\entities;

// Yii Imports
use \Yii;

// CMG Imports
use cmsgears\stripe\common\config\StripeProperties;

use cmsgears\stripe\common\services\interfaces\entities\IStripeCheckoutService;

class StripeCheckoutService extends \cmsgears\payment\common\services\entities\TransactionService implements IStripeCheckoutService {

    private $properties;

    public function __construct( $baseUrl = null ) {

        $this->properties = StripeProperties::getInstance();
    }

    // Static Methods ----------------------------------------------

    // Read ----------------

    // Data Provider ------

    // Create -----------

    public function createPayment( $token, $amount ) {

    	$user = Yii::$app->core->getAppUser();

        if( $this->properties->getStatus() == 'test' ) {

            $stripe = array(
              "secret_key"      => $this->properties->getTestSecretKey(),
              "publishable_key" => $this->properties->getTestPublishableKey()
            );
        }
        else {

            $stripe = array(
              "secret_key"      => $this->properties->getLiveSecretKey(),
              "publishable_key" => $this->properties->getLivePublishableKey()
            );
        }

        \Stripe\Stripe::setApiKey( $stripe[ 'secret_key' ] );

          $customer = \Stripe\Customer::create(array(
              'email' => $user->email,
              'source'  => $token
          ));

          $charge = \Stripe\Charge::create(array(
              'customer' => $customer->id,
              'amount'   => $amount*100,
              'currency' => $this->properties->getCurrency()
          ));

          return $charge;
    }

    // Update -----------

    public static function updateData( $payment, $charge ) {

		$payment->setDataMeta( 'id', $charge->id );
		$payment->setDataMeta( 'amount', $charge->amount );
		$payment->setDataMeta( 'balance_transaction', $charge->balance_transaction );

        $payment->update();
    }
}
