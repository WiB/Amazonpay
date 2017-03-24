<?php
namespace Spryker\Zed\Amazonpay\Business\Quote;

use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AdapterFactory;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToShipmentInterface;
use Spryker\Zed\Shipment\Business\ShipmentFacadeInterface;

class QuoteUpdateFactory
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
     * @var ShipmentFacadeInterface
     */
    protected $shipmentFacade;

    public function __construct(
        AdapterFactory $adapterFactory,
        AmazonpayConfig $config,
        AmazonpayToShipmentInterface $shipmentFacade
    ) {
        $this->adapterFactory = $adapterFactory;
        $this->config = $config;
        $this->shipmentFacade = $shipmentFacade;
    }

    /**
     * @return ShippingAddressDataQuoteUpdater
     */
    public function createShippingAddressQuoteDataUpdater()
    {
        return new ShippingAddressDataQuoteUpdater(
            $this->adapterFactory->createSetOrderReferenceDetailsAmazonpayAdapter(),
            $this->config
        );
    }

    /**
     * @return PrepareQuoteCollection
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
     * @return ShipmentDataQuoteInitializer
     */
    public function createShipmentDataQuoteInitializer()
    {
        return new ShipmentDataQuoteInitializer();
    }

    /**
     * @return ShipmentDataQuoteUpdater
     */
    public function createShipmentDataQuoteUpdater()
    {
        return new ShipmentDataQuoteUpdater(
            $this->shipmentFacade
        );
    }

    /**
     * @return CustomerDataQuoteUpdater
     */
    protected function createCustomerDataQuoteUpdater()
    {
        return new CustomerDataQuoteUpdater(
            $this->adapterFactory->createObtainProfileInformationAdapter(),
            $this->config
        );
    }

    /**
     * @return PaymentDataQuoteUpdater
     */
    protected function createPaymentDataQuoteUpdater()
    {
        return new PaymentDataQuoteUpdater();
    }

}
