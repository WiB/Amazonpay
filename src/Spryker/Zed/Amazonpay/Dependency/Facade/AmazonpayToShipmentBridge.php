<?php
namespace Spryker\Zed\Amazonpay\Dependency\Facade;


use Spryker\Zed\Shipment\Business\ShipmentFacadeInterface;

class AmazonpayToShipmentBridge implements AmazonpayToShipmentInterface
{
    protected $shipmentFacade;

    public function __construct(ShipmentFacadeInterface $shipmentFacade)
    {
        $this->shipmentFacade = $shipmentFacade;
    }

    /**
     * @param int $idMethod
     *
     * @return \Generated\Shared\Transfer\ShipmentMethodTransfer
     */
    public function getShipmentMethodTransferById($idMethod)
    {
        return $this->shipmentFacade->getShipmentMethodTransferById($idMethod);
    }

}
