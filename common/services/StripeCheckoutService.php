<?php
namespace cmsgears\stripe\common\services;

// Yii Imports
use \Yii;

// CMG Imports

class StripeCheckoutService extends \cmsgears\payment\common\services\PaymentService {

    // Static Methods ----------------------------------------------

    // Read ----------------

    // Data Provider ------

    // Create -----------

    public static function createPayment( $token, $amount ) {

        $user   = Yii::$app->cmgCore->getAppUser();

        $stripe = array(
          "secret_key"      => "sk_test_zpz0lWLPaB0JKVCKrZO4IwJd",
          "publishable_key" => "pk_test_JkdYJs3UBV76grl5DN9sKG2w"
        );

        \Stripe\Stripe::setApiKey( $stripe[ 'secret_key' ] );

          $customer = \Stripe\Customer::create(array(
              'email' => $user->email,
              'source'  => $token
          ));

          $charge = \Stripe\Charge::create(array(
              'customer' => $customer->id,
              'amount'   => $amount*100,
              'currency' => 'USD'
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