<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Amazonpay;

interface AmazonpayFactoryInterface
{

    /**
     * @TODO CR interface
     * @return \Spryker\Client\Quote\QuoteClient
     */
    public function getQuoteClient();

    /**
     * @return \Spryker\Client\Checkout\CheckoutClient
     */
    public function getCheckoutClient();

    /**
     * @return \Spryker\Shared\Amazonpay\AmazonpayConfig
     */
    public function getConfig();

    /**
     * @return \Spryker\Client\Shipment\ShipmentClient
     */
    public function getShipmentClient();

    /**
     * @return \Spryker\Client\Calculation\CalculationClient
     */
    public function getCalculationClient();

}
