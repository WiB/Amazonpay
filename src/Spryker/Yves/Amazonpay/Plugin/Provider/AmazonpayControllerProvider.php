<?php
namespace Spryker\Yves\Amazonpay\Plugin\Provider;

use Silex\Application;
use Spryker\Yves\Application\Plugin\Provider\YvesControllerProvider;

class AmazonpayControllerProvider extends YvesControllerProvider
{
    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app)
    {
        $this->createController('/amazonpay/checkout', 'amazonpay_checkout', 'Amazonpay', 'Payment', 'checkout');
        $this->createController('/amazonpay/confirm-purchase', 'amazonpay_confirm_purchase', 'Amazonpay', 'Payment', 'confirmPurchase');
        $this->createController('/amazonpay/paybutton', 'amazonpay_paybutton', 'Amazonpay', 'Widget', 'payButton');
        $this->createController('/amazonpay/checkout-widget', 'amazonpay_checkout_widget', 'Amazonpay', 'Widget', 'checkoutWidget');
    }
}
