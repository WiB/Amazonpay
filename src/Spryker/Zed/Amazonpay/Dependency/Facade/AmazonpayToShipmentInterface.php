<?php
/**
 * Created by PhpStorm.
 * User: dmitrikadykov
 * Date: 20/03/2017
 * Time: 13:56
 */

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