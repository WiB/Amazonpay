<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business;

use Spryker\Zed\Amazonpay\AmazonpayDependencyProvider;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AdapterFactory;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterFactory;
use Spryker\Zed\Amazonpay\Business\Order\Saver;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLogger;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\TransactionFactory;
use Spryker\Zed\Amazonpay\Business\Payment\Method\Amazonpay;
use Spryker\Zed\Amazonpay\Business\Quote\QuoteUpdateFactory;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Spryker\Zed\Amazonpay\AmazonpayConfig getConfig()
 * @method \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainer getQueryContainer()
 */
class AmazonpayBusinessFactory extends AbstractBusinessFactory
{

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\TransactionFactoryInterface
     */
    public function getTransactionFactory()
    {
        return new TransactionFactory(
            $this->getAdapterFactory(),
            $this->getConfig(),
            $this->createTransactionLogger(),
            $this->getQueryContainer(),
            $this->createAmazonpayPaymentMethod()
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Quote\QuoteUpdateFactoryInterface
     */
    public function getQuoteUpdateFactory()
    {
        return new QuoteUpdateFactory(
            $this->getAdapterFactory(),
            $this->getConfig(),
            $this->getShipmentFacade()
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToRefundInterface
     */
    public function getRefundFacade()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_REFUND);
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface
     */
    protected function getMoneyFacade()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_MONEY);
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToShipmentBridge
     */
    protected function getShipmentFacade()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_SHIPMENT);
    }

   /**
    * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\AdapterFactoryInterface
    */
    protected function getAdapterFactory()
    {
        return new AdapterFactory(
            $this->getConfig(),
            $this->getConverterFactory(),
            $this->getMoneyFacade()
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterFactory
     */
    protected function getConverterFactory()
    {
        return new ConverterFactory();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Method\AmazonpayInterface
     */
    protected function createAmazonpayPaymentMethod()
    {
        return new Amazonpay();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Order\SaverInterface
     */
    public function createOrderSaver()
    {
        return new Saver();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLoggerInterface
     */
    public function createTransactionLogger()
    {
        return new TransactionLogger($this->getConfig()->getErrorReportLevel());
    }

}
