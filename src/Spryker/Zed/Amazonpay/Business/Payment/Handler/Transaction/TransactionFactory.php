<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Spryker\Zed\Amazonpay\AmazonpayConfigInterface;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AdapterFactoryInterface;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLoggerInterface;
use Spryker\Zed\Amazonpay\Business\Payment\Method\AmazonpayInterface;
use Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainerInterface;

class TransactionFactory implements TransactionFactoryInterface
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Adapter\AdapterFactory
     */
    protected $adapterFactory;

    /**
     * @var \Spryker\Zed\Amazonpay\AmazonpayConfigInterface
     */
    protected $config;

    /**
     * @var \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainerInterface
     */
    protected $amazonpayQueryContainer;

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Payment\Method\AmazonpayInterface
     */
    protected $amazonpayPaymentMethod;

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLoggerInterface
     */
    protected $transactionLogger;

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Api\Adapter\AdapterFactoryInterface $adapterFactory
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfigInterface $config
     * @param \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLoggerInterface $transactionLogger
     * @param \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainerInterface $amazonpayQueryContainer
     * @param \Spryker\Zed\Amazonpay\Business\Payment\Method\AmazonpayInterface $amazonpayPaymentMethod
     */
    public function __construct(
        AdapterFactoryInterface $adapterFactory,
        AmazonpayConfigInterface $config,
        TransactionLoggerInterface $transactionLogger,
        AmazonpayQueryContainerInterface $amazonpayQueryContainer,
        AmazonpayInterface $amazonpayPaymentMethod
    ) {
        $this->adapterFactory = $adapterFactory;
        $this->config = $config;
        $this->transactionLogger = $transactionLogger;
        $this->amazonpayQueryContainer = $amazonpayQueryContainer;
        $this->amazonpayPaymentMethod = $amazonpayPaymentMethod;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\QuoteTransactionInterface
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
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\QuoteTransactionInterface
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
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\QuoteTransactionInterface
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
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface
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
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\QuoteTransactionInterface
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
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface
     */
    public function createCaptureOrderTransaction()
    {
        $handler = new CaptureOrderTransaction(
            $this->adapterFactory->createCaptureOrderAdapter(),
            $this->config,
            $this->transactionLogger,
            $this->amazonpayQueryContainer
        );

        $handler->registerMethodMapper(
            $this->amazonpayPaymentMethod
        );

        return $handler;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface
     */
    public function createCloseOrderTransaction()
    {
        return new CloseOrderTransaction(
            $this->adapterFactory->createCloseOrderAdapter(),
            $this->config,
            $this->transactionLogger,
            $this->amazonpayQueryContainer
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface
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
