<?php
namespace Spryker\Zed\Amazonpay\Business;

use Spryker\Zed\Amazonpay\Business\Api\Adapter\ConfirmOrderReferenceAmazonpayAdapter;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\GetOrderReferenceDetailsAmazonpayAdapter;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\SetOrderReferenceDetailsAmazonpayAdapter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ConfirmOrderReferenceConverter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\GetOrderReferenceDetailsConverter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\SetOrderReferenceDetailsConverter;
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
     * @return SetOrderReferenceDetailsAmazonpayAdapter
     */
    protected function createSetOrderReferenceDetailsAmazonpayAdapter()
    {
        return new SetOrderReferenceDetailsAmazonpayAdapter(
            $this->getConfig(),
            $this->createSetOrderReferenceDetailsConverter()
        );
    }

    /**
     * @return ConfirmOrderReferenceAmazonpayAdapter
     */
    protected function createConfirmOrderReferenceAmazonpayAdapter()
    {
        return new ConfirmOrderReferenceAmazonpayAdapter(
            $this->getConfig(),
            $this->createConfirmOrderReferenceConverter()
        );
    }

    /**
     * @return GetOrderReferenceDetailsAmazonpayAdapter
     */
    protected function createGetOrderReferenceDetailsAmazonpayAdapter()
    {
        return new GetOrderReferenceDetailsAmazonpayAdapter(
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
