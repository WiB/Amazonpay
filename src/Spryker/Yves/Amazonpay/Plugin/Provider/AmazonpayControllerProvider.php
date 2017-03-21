<?php
namespace Spryker\Yves\Amazonpay\Plugin\Provider;

use Silex\Application;
use Spryker\Yves\Application\Plugin\Provider\YvesControllerProvider;

class AmazonpayControllerProvider extends YvesControllerProvider
{
    const CHECKOUT = 'amazonpay_checkout';
    const CONFIRM_PURCHASE =  'amazonpay_confirm_purchase';
    const SUCCESS = 'amazonpay_success';
    const CHANGE_PAYMENT_METHOD = 'amazonpay_change_payment_method';
    const PAYMENT_FAILED = 'amazonpay_payment_failed';

    const SET_ORDER_REFERENCE = 'amazonpay_set_order_reference';
    const SET_SHIPMENT_METHOD = 'amazonpay_set_shipment_method';
    const GET_SHIPMENT_METHODS = 'amazonpay_get_shipment_methods';

    const PAYBUTTON = 'amazonpay_paybutton';
    const CHECKOUT_WIDGET = 'amazonpay_checkout_widget';
    const WALLET_WIDGET = 'amazonpay_wallet_widget';

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app)
    {
        $this->createController('/amazonpay/checkout', self::CHECKOUT, 'Amazonpay', 'Payment', 'checkout');
        $this->createController('/amazonpay/confirm/purchase', self::CONFIRM_PURCHASE, 'Amazonpay', 'Payment', 'confirmPurchase');
        $this->createController('/amazonpay/success', self::SUCCESS, 'Amazonpay', 'Payment', 'success');
        $this->createController('/amazonpay/change-payment-method', self::CHANGE_PAYMENT_METHOD, 'Amazonpay', 'Payment', 'changePaymentMethod');
        $this->createController('/amazonpay/payment-failed', self::PAYMENT_FAILED, 'Amazonpay', 'Payment', 'paymentFailed');

        // ajax
        $this->createController('/amazonpay/set-order-reference', self::SET_ORDER_REFERENCE, 'Amazonpay', 'Payment', 'setOrderReference');
        $this->createController('/amazonpay/set-shipment-method', self::SET_SHIPMENT_METHOD, 'Amazonpay', 'Payment', 'setShipmentMethod');
        $this->createController('/amazonpay/get-shipment-methods', self::GET_SHIPMENT_METHODS, 'Amazonpay', 'Payment', 'getShipmentMethods');

        // widgets
        $this->createController('/amazonpay/paybutton', self::PAYBUTTON, 'Amazonpay', 'Widget', 'payButton');
        $this->createController('/amazonpay/checkout-widget', self::CHECKOUT_WIDGET, 'Amazonpay', 'Widget', 'checkoutWidget');
        $this->createController('/amazonpay/wallet-widget', self::WALLET_WIDGET, 'Amazonpay', 'Widget', 'walletWidget');
    }
}
