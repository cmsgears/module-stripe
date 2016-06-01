<?php
namespace cmsgears\stripe\common\services;

// Yii Imports
use \Yii;

// CMG Imports
use cmsgears\stripe\common\config\StripeProperties;

class StripeCheckoutService extends \cmsgears\payment\common\services\PaymentService {

    private $properties;

    public function __construct( $baseUrl = null ) {

        $this->properties = StripeProperties::getInstance();
    }

    // Static Methods ----------------------------------------------

    // Read ----------------

    // Data Provider ------

    // Create -----------

    public function createPayment( $token, $amount ) {

        $user   = Yii::$app->cmgCore->getAppUser();

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

        $payment->setDataAttribute( 'id', $charge->id );
        $payment->setDataAttribute( 'amount', $charge->amount );
        $payment->setDataAttribute( 'balance_transaction', $charge->balance_transaction );
        $payment->update();
    }


}

?>