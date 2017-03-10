<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Command;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByOrderInterface;
use Generated\Shared\Transfer\AmazonpayPaymentTransfer;
use ArrayObject;

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

        $customerTransfer = new CustomerTransfer();
        $customerTransfer->fromArray($this->getCustomerEntity($orderEntity)->toArray(), true);

        $orderTransfer = $this
            ->getFactory()
            ->getSalesFacade()
            ->getOrderByIdSalesOrder(
                $orderEntity->getIdSalesOrder()
            );

        if (sizeof($orderEntity->getItems()) != sizeof($salesOrderItems)) {
            $paymentTransfer->setIsPartial(true);

            $selectedItems = new ArrayObject();
            foreach ($salesOrderItems as $salesOrderItem) {
                $salesOrderItemTransfer = new ItemTransfer();
                $salesOrderItemTransfer->fromArray($salesOrderItem->toArray(), true);
                $salesOrderItemTransfer->setUnitGrossPrice($salesOrderItem->getGrossPrice());
                $selectedItems[] = $salesOrderItemTransfer;
            }

            $paymentTransfer->setItems($selectedItems);
        }

        $orderTransfer->setAmazonpayPayment($paymentTransfer);
        $orderTransfer->setCustomer($customerTransfer);

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
