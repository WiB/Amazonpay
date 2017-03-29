<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AdapterFactory;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLogger;
use Spryker\Zed\Amazonpay\Business\Payment\Method\Amazonpay;
use Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainer;

class TransactionFactory
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
     * @var \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainer
     */
    protected $amazonpayQueryContainer;

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Payment\Method\Amazonpay
     */
    protected $amazonpayPaymentMethod;

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLogger
     */
    protected $transactionLogger;

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Api\Adapter\AdapterFactory $adapterFactory
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfig $config
     * @param \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainer $amazonpayQueryContainer
     * @param \Spryker\Zed\Amazonpay\Business\Payment\Method\Amazonpay $amazonpayPaymentMethod
     */
    public function __construct(
        AdapterFactory $adapterFactory,
        AmazonpayConfig $config,
        AmazonpayQueryContainer $amazonpayQueryContainer,
        Amazonpay $amazonpayPaymentMethod
    ) {
        $this->adapterFactory = $adapterFactory;
        $this->config = $config;
        $this->transactionLogger = new TransactionLogger($config->getErrorReportLevel());
        $this->amazonpayQueryContainer = $amazonpayQueryContainer;
        $this->amazonpayPaymentMethod = $amazonpayPaymentMethod;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\ConfirmOrderReferenceTransaction
     */
    public function createConfirmOrderReferenceTransaction()
    {
        $handler = new ConfirmOrderReferenceTransaction(
            $this->adapterFactory->createConfirmOrderReferenceAmazonpayAdapter(),
            $this->config,
            $this->transactionLogger
        );

        $handler->registerMethodMapper(
            $this->amazonpayPaymentMethod
        );

        return $handler;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\SetOrderReferenceDetailsTransaction
     */
    public function createSetOrderReferenceTransaction()
    {
        $handler = new SetOrderReferenceDetailsTransaction(
            $this->adapterFactory->createSetOrderReferenceDetailsAmazonpayAdapter(),
            $this->config,
            $this->transactionLogger
        );

        $handler->registerMethodMapper(
            $this->amazonpayPaymentMethod
        );

        return $handler;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\GetOrderReferenceDetailsTransaction
     */
    public function createGetOrderReferenceDetailsTransaction()
    {
        $handler = new GetOrderReferenceDetailsTransaction(
            $this->adapterFactory->createGetOrderReferenceDetailsAmazonpayAdapter(),
            $this->config,
            $this->transactionLogger
        );

        $handler->registerMethodMapper(
            $this->amazonpayPaymentMethod
        );

        return $handler;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\CancelOrderTransaction
     */
    public function createCancelOrderTransaction()
    {
        $handler = new CancelOrderTransaction(
            $this->adapterFactory->createCancelOrderAdapter(),
            $this->config,
            $this->transactionLogger
        );

        $handler->registerMethodMapper(
            $this->amazonpayPaymentMethod
        );

        return $handler;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\AuthorizeOrderTransaction
     */
    public function createAuthorizeOrderTransaction()
    {
        $handler = new AuthorizeOrderTransaction(
            $this->adapterFactory->createAuthorizeOrderAdapter(),
            $this->config,
            $this->transactionLogger
        );

        $handler->registerMethodMapper(
            $this->amazonpayPaymentMethod
        );

        return $handler;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\CloseOrderTransaction
     */
    public function createCloseOrderTransaction()
    {
        return new CloseOrderTransaction(
            $this->adapterFactory->createCloseOrderAdapter(),
            $this->config,
            $this->transactionLogger,
            $this->amazonpayQueryContainer,
            $this->amazonpayPaymentMethod
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\RefundOrderTransaction
     */
    public function createRefundOrderTransaction()
    {
        return new RefundOrderTransaction(
            $this->adapterFactory->createRefundOrderAdapter(),
            $this->config,
            $this->transactionLogger,
            $this->amazonpayQueryContainer,
            $this->amazonpayPaymentMethod
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\HandleDeclinedOrderTransaction
     */
    public function createHandleDeclinedOrderTransaction()
    {
        return new HandleDeclinedOrderTransaction(
            $this->createGetOrderReferenceDetailsTransaction(),
            $this->createCancelOrderTransaction()
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\ConfirmPurchaseTransactionCollection
     */
    public function createConfirmPurchaseTransactionCollection()
    {
        return new ConfirmPurchaseTransactionCollection(
            [
                $this->createSetOrderReferenceTransaction(),
                $this->createConfirmOrderReferenceTransaction(),
                $this->createGetOrderReferenceDetailsTransaction(),
                $this->createAuthorizeOrderTransaction(),
                $this->createHandleDeclinedOrderTransaction(),
            ]
        );
    }

}
