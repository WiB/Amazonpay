<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Quote;

use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AdapterFactory;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToShipmentBridge;

class QuoteUpdateFactory
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Adapter\AdapterFactory
     */
    protected $adapterFactory;

    /**
     * @var \Spryker\Zed\Amazonpay\AmazonpayConfig
     */
    protected $config;

    /**
     * @var \Spryker\Zed\Shipment\Business\ShipmentFacadeInterface
     */
    protected $shipmentFacade;

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Api\Adapter\AdapterFactory $adapterFactory
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfig $config
     * @param \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToShipmentBridge $shipmentFacade
     */
    public function __construct(
        AdapterFactory $adapterFactory,
        AmazonpayConfig $config,
        AmazonpayToShipmentBridge $shipmentFacade
    ) {
        $this->adapterFactory = $adapterFactory;
        $this->config = $config;
        $this->shipmentFacade = $shipmentFacade;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Quote\ShippingAddressDataQuoteUpdater
     */
    public function createShippingAddressQuoteDataUpdater()
    {
        return new ShippingAddressDataQuoteUpdater(
            $this->adapterFactory->createSetOrderReferenceDetailsAmazonpayAdapter(),
            $this->config
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Quote\PrepareQuoteCollection
     */
    public function createQuoteDataInitializer()
    {
        return new PrepareQuoteCollection(
            [
                $this->createCustomerDataQuoteUpdater(),
                $this->createShipmentDataQuoteInitializer(),
                $this->createPaymentDataQuoteUpdater(),
            ]
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Quote\ShipmentDataQuoteInitializer
     */
    public function createShipmentDataQuoteInitializer()
    {
        return new ShipmentDataQuoteInitializer();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Quote\ShipmentDataQuoteUpdater
     */
    public function createShipmentDataQuoteUpdater()
    {
        return new ShipmentDataQuoteUpdater(
            $this->shipmentFacade
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Quote\CustomerDataQuoteUpdater
     */
    protected function createCustomerDataQuoteUpdater()
    {
        return new CustomerDataQuoteUpdater(
            $this->adapterFactory->createObtainProfileInformationAdapter(),
            $this->config
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Quote\PaymentDataQuoteUpdater
     */
    protected function createPaymentDataQuoteUpdater()
    {
        return new PaymentDataQuoteUpdater();
    }

}
