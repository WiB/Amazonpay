<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByOrderInterface;
use Generated\Shared\Transfer\AmazonpayPaymentTransfer;

/**
 * @method \Spryker\Zed\Amazonpay\Business\AmazonpayFacade getFacade()
 * @method \Spryker\Zed\Amazonpay\Communication\AmazonpayCommunicationFactory getFactory()
 */
abstract class AbstractAmazonpayCommandPlugin extends AbstractPlugin implements CommandByOrderInterface
{

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param array $salesOrderItems
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    protected function getOrderTransfer(SpySalesOrder $orderEntity, array $salesOrderItems = [])
    {
        $paymentTransfer = new AmazonpayPaymentTransfer();
        $paymentTransfer->fromArray($this->getPaymentEntity($orderEntity)->toArray(), true);

        $orderTransfer = $this
            ->getFactory()
            ->getSalesFacade()
            ->getOrderByIdSalesOrder(
                $orderEntity->getIdSalesOrder()
            );

        $orderTransfer->setAmazonpayPayment($paymentTransfer);

        return $orderTransfer;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay
     */
    protected function getPaymentEntity(SpySalesOrder $orderEntity)
    {
        return $orderEntity->getSpyPaymentAmazonpays()->getFirst();
    }

    /**
     * @param SpySalesOrder $orderEntity
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomer
     */
    protected function getCustomerEntity(SpySalesOrder $orderEntity)
    {
        return $orderEntity->getCustomer();
    }

}
