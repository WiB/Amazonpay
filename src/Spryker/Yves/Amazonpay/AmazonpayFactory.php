<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Amazonpay;

use Spryker\Shared\Amazonpay\AmazonpayConfig;
use Spryker\Yves\Kernel\AbstractFactory;

class AmazonpayFactory extends AbstractFactory implements AmazonpayFactoryInterface
{

    /**
     * @TODO CR interface missing
     * @return \Spryker\Client\Quote\QuoteClient
     */
    public function getQuoteClient()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_QUOTE);
    }

    /**
     * @TODO CR interface
     * @return \Spryker\Client\Checkout\CheckoutClient
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
     * @return \Spryker\Client\Shipment\ShipmentClient
     */
    public function getShipmentClient()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_SHIPMENT);
    }

    /**
     * @return \Spryker\Client\Calculation\CalculationClient
     */
    public function getCalculationClient()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_CALCULATION);
    }

}
