<?php
namespace Spryker\Zed\Amazonpay\Business;

use Spryker\Zed\Amazonpay\AmazonpayDependencyProvider;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AuthorizeOrderAdapter;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\ConfirmOrderReferenceAdapter;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\GetOrderReferenceDetailsAdapter;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\ObtainProfileInformationAdapter;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\SetOrderReferenceDetailsAdapter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\AuthorizeOrderConverter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ConfirmOrderReferenceConverter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\GetOrderReferenceDetailsConverter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ObtainProfileInformationConverter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\SetOrderReferenceDetailsConverter;
use Spryker\Zed\Amazonpay\Business\Quote\CustomerDataQuoteUpdater;
use Spryker\Zed\Amazonpay\Business\Order\Saver;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\AuthorizeOrderTransaction;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\ConfirmPurchaseTransactionCollection;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\GetOrderReferenceDetailsTransaction;
use Spryker\Zed\Amazonpay\Business\Quote\PrepareQuoteCollection;
use Spryker\Zed\Amazonpay\Business\Quote\ShipmentDataQuoteUpdater;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Amazonpay\Business\Quote\PaymentDataQuoteUpdater;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\ConfirmOrderReferenceTransaction;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\SetOrderReferenceDetailsTransaction;
use Spryker\Zed\Amazonpay\Business\Payment\Method\Amazonpay;
use Generated\Shared\Transfer\QuoteTransfer;

/**
 * @method \Spryker\Zed\Amazonpay\AmazonpayConfig getConfig()
 * @method \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainer getQueryContainer()
 */
class AmazonpayBusinessFactory extends AbstractBusinessFactory
{
    public function handleCartWithAmazonpay(QuoteTransfer $quoteTransfer)
    {
        $quoteTransfer = $this->createQuoteDataUpdater()->update($quoteTransfer);

        return $quoteTransfer;
    }

    /**
     * @return PaymentDataQuoteUpdater
     */
    protected function createQuoteDataUpdater()
    {
        return new PrepareQuoteCollection(
            [
                $this->createCustomerDataQuoteUpdater(),
                $this->createShipmentDataQuoteUpdater(),
                $this->createPaymentDataQuoteUpdater(),
            ]
        );
    }

    /**
     * @return CustomerDataQuoteUpdater
     */
    protected function createCustomerDataQuoteUpdater()
    {
        return new CustomerDataQuoteUpdater(
            $this->createObtainProfileInformationAdapter(),
            $this->getConfig()
        );
    }

    /**
     * @return ShipmentDataQuoteUpdater
     */
    protected function createShipmentDataQuoteUpdater()
    {
        return new ShipmentDataQuoteUpdater();
    }

    /**
     * @return PaymentDataQuoteUpdater
     */
    protected function createPaymentDataQuoteUpdater()
    {
        return new PaymentDataQuoteUpdater();
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
     * @return AuthorizeOrderTransaction
     */
    protected function createAuthorizeOrderTransactionHandler()
    {
        $handler = new AuthorizeOrderTransaction(
            $this->createAuthorizeOrderAdapter(),
            $this->getConfig()
        );

        $handler->registerMethodMapper(
            $this->createAmazonpayPaymentMethod()
        );

        return $handler;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface
     */
    protected function getMoneyFacade()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_MONEY);
    }

    /**
     * @return ConfirmPurchaseTransactionCollection
     */
    public function createConfirmPurchaseTransactionHandlerCollection()
    {
        return new ConfirmPurchaseTransactionCollection(
            [
                $this->createSetOrderReferenceTransactionHandler(),
                $this->createConfirmOrderReferenceTransactionHandler(),
                $this->createGetOrderReferenceDetailsTransactionHandler(),
                $this->createAuthorizeOrderTransactionHandler(),
            ]
        );
    }

    /**
     * @return ObtainProfileInformationAdapter
     */
    protected function createObtainProfileInformationAdapter()
    {
        return new ObtainProfileInformationAdapter(
            $this->getConfig(),
            $this->createObtainProfileInformationConverter(),
            $this->getMoneyFacade()
        );
    }

    /**
     * @return SetOrderReferenceDetailsAdapter
     */
    protected function createSetOrderReferenceDetailsAmazonpayAdapter()
    {
        return new SetOrderReferenceDetailsAdapter(
            $this->getConfig(),
            $this->createSetOrderReferenceDetailsConverter(),
            $this->getMoneyFacade()
        );
    }

    /**
     * @return ConfirmOrderReferenceAdapter
     */
    protected function createConfirmOrderReferenceAmazonpayAdapter()
    {
        return new ConfirmOrderReferenceAdapter(
            $this->getConfig(),
            $this->createConfirmOrderReferenceConverter(),
            $this->getMoneyFacade()
        );
    }

    /**
     * @return GetOrderReferenceDetailsAdapter
     */
    protected function createGetOrderReferenceDetailsAmazonpayAdapter()
    {
        return new GetOrderReferenceDetailsAdapter(
            $this->getConfig(),
            $this->createGetOrderReferenceDetailsConverter(),
            $this->getMoneyFacade()
        );
    }

    /**
     * @return AuthorizeOrderAdapter
     */
    protected function createAuthorizeOrderAdapter()
    {
        return new AuthorizeOrderAdapter(
            $this->getConfig(),
            $this->createAuthorizeOrderConverter(),
            $this->getMoneyFacade()
        );
    }

    /**
     * @return ObtainProfileInformationConverter
     */
    protected function createObtainProfileInformationConverter()
    {
        return new ObtainProfileInformationConverter();
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
     * @return AuthorizeOrderConverter
     */
    protected function createAuthorizeOrderConverter()
    {
        return new AuthorizeOrderConverter();
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
