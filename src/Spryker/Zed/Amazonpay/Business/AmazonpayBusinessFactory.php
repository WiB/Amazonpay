<?php
namespace Spryker\Zed\Amazonpay\Business;

use Spryker\Zed\Amazonpay\Business\Api\Adapter\ConfirmOrderReferenceAdapter;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\GetOrderReferenceDetailsAdapter;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\SetOrderReferenceDetailsAdapter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ConfirmOrderReferenceConverter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\GetOrderReferenceDetailsConverter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\SetOrderReferenceDetailsConverter;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\ConfirmPurchaseTransactionCollection;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\GetOrderReferenceDetailsTransaction;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Amazonpay\Business\Model\QuoteDataUpdater;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\ConfirmOrderReferenceTransaction;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\SetOrderReferenceDetailsTransaction;
use Spryker\Zed\Amazonpay\Business\Payment\Method\Amazonpay;

/**
 * @method \Spryker\Zed\Amazonpay\AmazonpayConfig getConfig()
 * @method \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainer getQueryContainer()
 */
class AmazonpayBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return QuoteDataUpdater
     */
    public function createQuoteDataUpdater()
    {
        return new QuoteDataUpdater();
    }

    /**
     * @return ConfirmOrderReferenceTransaction
     */
    public function createConfirmOrderReferenceTransactionHandler()
    {
        $handler = new ConfirmOrderReferenceTransaction(
            $this->createConfirmOrderReferenceAmazonpayAdapter(),
            $this->getConfig()
        );

        $handler->registerMethodMapper(
            $this->createAmazonpayPaymentMethod()
        );

        return $handler;
    }

    /**
     * @return SetOrderReferenceDetailsTransaction
     */
    public function createSetOrderReferenceTransactionHandler()
    {
        $handler = new SetOrderReferenceDetailsTransaction(
            $this->createSetOrderReferenceDetailsAmazonpayAdapter(),
            $this->getConfig()
        );

        $handler->registerMethodMapper(
            $this->createAmazonpayPaymentMethod()
        );

        return $handler;
    }

    /**
     * @return GetOrderReferenceDetailsTransaction
     */
    public function createGetOrderReferenceDetailsTransactionHandler()
    {
        $handler = new GetOrderReferenceDetailsTransaction(
            $this->createGetOrderReferenceDetailsAmazonpayAdapter(),
            $this->getConfig()
        );

        $handler->registerMethodMapper(
            $this->createAmazonpayPaymentMethod()
        );

        return $handler;
    }

    /**
     * @return ConfirmPurchaseTransactionCollection
     */
    public function createConfirmPurchaseTransactionHandlerCollection()
    {
        return new ConfirmPurchaseTransactionCollection(
            $this->createSetOrderReferenceTransactionHandler(),
            $this->createConfirmOrderReferenceTransactionHandler(),
            $this->createGetOrderReferenceDetailsTransactionHandler()
        );
    }

    /**
     * @return SetOrderReferenceDetailsAdapter
     */
    protected function createSetOrderReferenceDetailsAmazonpayAdapter()
    {
        return new SetOrderReferenceDetailsAdapter(
            $this->getConfig(),
            $this->createSetOrderReferenceDetailsConverter()
        );
    }

    /**
     * @return ConfirmOrderReferenceAdapter
     */
    protected function createConfirmOrderReferenceAmazonpayAdapter()
    {
        return new ConfirmOrderReferenceAdapter(
            $this->getConfig(),
            $this->createConfirmOrderReferenceConverter()
        );
    }

    /**
     * @return GetOrderReferenceDetailsAdapter
     */
    protected function createGetOrderReferenceDetailsAmazonpayAdapter()
    {
        return new GetOrderReferenceDetailsAdapter(
            $this->getConfig(),
            $this->createGetOrderReferenceDetailsConverter()
        );
    }

    /**
     * @return SetOrderReferenceDetailsConverter
     */
    protected function createSetOrderReferenceDetailsConverter()
    {
        return new SetOrderReferenceDetailsConverter();
    }

    /**
     * @return ConfirmOrderReferenceConverter
     */
    protected function createConfirmOrderReferenceConverter()
    {
        return new ConfirmOrderReferenceConverter();
    }

    /**
     * @return GetOrderReferenceDetailsConverter
     */
    protected function createGetOrderReferenceDetailsConverter()
    {
        return new GetOrderReferenceDetailsConverter();
    }

    /**
     * @return Amazonpay
     */
    protected function createAmazonpayPaymentMethod()
    {
        return new Amazonpay();
    }

}
