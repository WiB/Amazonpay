<?php
namespace Spryker\Zed\Amazonpay\Dependency\Facade;

interface AmazonpayToShipmentInterface
{
    /**
     * @api
     *
     * @param int $idMethod
     *
     * @return \Generated\Shared\Transfer\ShipmentMethodTransfer
     */
    public function getShipmentMethodTransferById($idMethod);

}