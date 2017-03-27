<?php
namespace Spryker\Zed\Amazonpay\Business;

use Spryker\Zed\Amazonpay\AmazonpayDependencyProvider;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AdapterFactory;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterFactory;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\TransactionFactory;
use Spryker\Zed\Amazonpay\Business\Order\Saver;
use Spryker\Zed\Amazonpay\Business\Quote\QuoteUpdateFactory;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToRefundInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Amazonpay\Business\Payment\Method\Amazonpay;

/**
 * @method \Spryker\Zed\Amazonpay\AmazonpayConfig getConfig()
 * @method \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainer getQueryContainer()
 */
class AmazonpayBusinessFactory extends AbstractBusinessFactory
{

    /**
     * @return TransactionFactory
     */
    public function getTransactionFactory()
    {
        return new TransactionFactory(
            $this->getAdapterFactory(),
            $this->getConfig(),
            $this->getQueryContainer(),
            $this->createAmazonpayPaymentMethod()
        );
    }

    /**
     * @return QuoteUpdateFactory
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
     * @return AmazonpayToRefundInterface
     */
    public function createRefundFacade()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_REFUND);
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface
     */
    protected function getMoneyFacade()
    {
        $this->getShipmentFacade();

        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_MONEY);
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToShipmentInterface
     */
    protected function getShipmentFacade()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_SHIPMENT);
    }

   /**
     * @return AdapterFactory
     */
    protected function getAdapterFactory()
    {
        return new AdapterFactory(
            $this->getConfig(), $this->getConverterFactory(), $this->getMoneyFacade()
        );
    }

    /**
     * @return ConverterFactory
     */
    protected function getConverterFactory()
    {
        return new ConverterFactory();
    }

    /**
     * @return Amazonpay
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

}
