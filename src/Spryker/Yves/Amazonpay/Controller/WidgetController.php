<?php
namespace Spryker\Yves\Amazonpay\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;
use Spryker\Yves\Amazonpay\AmazonpayFactory;

/**
 * @method AmazonpayFactory getFactory()
 * @method \Spryker\Client\Amazonpay\AmazonpayClient getClient()
 */
class WidgetController extends AbstractController
{
    public function payButtonAction()
    {
        $quote = $this->getFactory()->getQuoteClient()->getQuote();
        $logout =  $quote->getAmazonpayPayment()
                   && $quote->getAmazonpayPayment()->getAuthorizationDetails()
                   && $quote->getAmazonpayPayment()->getAuthorizationDetails()->getIsDeclined();

        return [
            'amazonConfig' => $this->getFactory()->getConfig(),
            'logout' => $logout,
        ];

    }

    public function checkoutWidgetAction()
    {
        return [
            'amazonConfig' => $this->getFactory()->getConfig()
        ];

    }

    public function walletWidgetAction()
    {
        return [
            'amazonConfig' => $this->getFactory()->getConfig()
        ];

    }

}