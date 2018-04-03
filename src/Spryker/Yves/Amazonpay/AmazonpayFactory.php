<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Amazonpay;

use Spryker\Shared\Amazonpay\AmazonpayConfig;
use Spryker\Yves\Kernel\AbstractFactory;

class AmazonpayFactory extends AbstractFactory implements AmazonpayFactoryInterface
{

    /**
     * @return \Spryker\Client\Cart\CartClientInterface
     */
    public function getCartClient()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_CART);
    }

    /**
     * @return \Spryker\Client\Checkout\CheckoutClientInterface
     */
    public function getCheckoutClient()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_CHECKOUT);
    }

    /**
     * @return \Spryker\Shared\Amazonpay\AmazonpayConfig
     */
    public function getConfig()
    {
        return new AmazonpayConfig();
    }

    /**
     * @return \Spryker\Client\Shipment\ShipmentClientInterface
     */
    public function getShipmentClient()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_SHIPMENT);
    }

    /**
     * @return \Spryker\Client\Calculation\CalculationClientInterface
     */
    public function getCalculationClient()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_CALCULATION);
    }

}
