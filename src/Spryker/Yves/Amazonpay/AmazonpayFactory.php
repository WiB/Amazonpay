<?php
namespace Spryker\Yves\Amazonpay;

use Spryker\Client\Calculation\CalculationClient;
use Spryker\Client\Checkout\CheckoutClient;
use Spryker\Client\Quote\QuoteClient;
use Spryker\Client\Shipment\ShipmentClient;
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
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_CHECKOUT);
    }

    /**
     * @return AmazonpayConfig
     */
    public function getConfig()
    {
        return new AmazonpayConfig();
    }

    /**
     * @return ShipmentClient
     */
    public function getShipmentClient()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_SHIPMENT);
    }

    /**
     * @return CalculationClient
     */
    public function getCalculationClient()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_CALCULATION);
    }

}
