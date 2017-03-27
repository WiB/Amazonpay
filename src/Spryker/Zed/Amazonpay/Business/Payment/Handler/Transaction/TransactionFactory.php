<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;


use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AdapterFactory;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLogger;
use Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainer;
use Spryker\Zed\Amazonpay\Business\Payment\Method\Amazonpay;

class TransactionFactory
{
    /**
     * @var AdapterFactory
     */
    protected $adapterFactory;

    /**
     * @var AmazonpayConfig
     */
    protected $config;

    /**
     * @var AmazonpayQueryContainer
     */
    protected $amazonpayQueryContainer;

    /**
     * @var Amazonpay
     */
    protected $amazonpayPaymentMethod;

    /**
     * @var TransactionLogger
     */
    protected $transactionLogger;

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
     * @return ConfirmOrderReferenceTransaction
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
     * @return SetOrderReferenceDetailsTransaction
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
     * @return GetOrderReferenceDetailsTransaction
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
     * @return CancelOrderTransaction
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
     * @return AuthorizeOrderTransaction
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
     * @return CloseOrderTransaction
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
     * @return RefundOrderTransaction
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
     * @return HandleDeclinedOrderTransaction
     */
    public function createHandleDeclinedOrderTransaction()
    {
        return new HandleDeclinedOrderTransaction(
            $this->createGetOrderReferenceDetailsTransaction(),
            $this->createCancelOrderTransaction()
        );
    }

    /**
     * @return ConfirmPurchaseTransactionCollection
     */
    public function createConfirmPurchaseTransactionCollection()
    {
        return new ConfirmPurchaseTransactionCollection(
            [
                $this->createSetOrderReferenceTransaction(),
                $this->createConfirmOrderReferenceTransaction(),
                $this->createGetOrderReferenceDetailsTransaction(),
                $this->createAuthorizeOrderTransaction(),
                $this->createHandleDeclinedOrderTransaction()
            ]
        );
    }
}
