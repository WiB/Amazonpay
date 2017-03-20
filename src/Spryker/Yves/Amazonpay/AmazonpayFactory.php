<?php
namespace Spryker\Yves\Amazonpay;

use Spryker\Client\Checkout\CheckoutClient;
use Spryker\Client\Quote\QuoteClient;
use Spryker\Shared\Amazonpay\AmazonpayConfig;
use Spryker\Yves\Kernel\AbstractFactory;

class AmazonpayFactory extends AbstractFactory
{
    /**
     * @return QuoteClient
     */
    public function getQuoteClient()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_QUOTE);
    }

    /**
     * @return CheckoutClient
     */
    public function getCheckoutClient()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CHECKOUT_CLIENT);
    }

    /**
     * @return AmazonpayConfig
     */
    public function getConfig()
    {
        return new AmazonpayConfig();
    }

    public function getShipmentClient()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_SHIPMENT);
    }

}
