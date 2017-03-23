<?php

namespace Spryker\Zed\Amazonpay\Dependency\Facade;

interface AmazonpayToSalesInterface
{

    /**
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function getOrderByIdSalesOrder($idSalesOrder);

}

