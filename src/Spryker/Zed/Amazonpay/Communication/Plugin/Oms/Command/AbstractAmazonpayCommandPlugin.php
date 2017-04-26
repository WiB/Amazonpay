<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Command;

use Generated\Shared\Transfer\AmazonpayAuthorizationDetailsTransfer;
use Generated\Shared\Transfer\AmazonpayCaptureDetailsTransfer;
use Generated\Shared\Transfer\AmazonpayPaymentTransfer;
use Generated\Shared\Transfer\AmazonpayRefundDetailsTransfer;
use Generated\Shared\Transfer\AmazonpayResponseHeaderTransfer;
use Generated\Shared\Transfer\AmazonpayStatusTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Shared\Amazonpay\AmazonpayConstants;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByOrderInterface;

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

        $responseHeader = new AmazonpayResponseHeaderTransfer();
        $responseHeader->setIsSuccess(true);
        $paymentTransfer->setResponseHeader($responseHeader);

        $authDetailsTransfer = new AmazonpayAuthorizationDetailsTransfer();
        $authDetailsTransfer->fromArray($this->getPaymentEntity($orderEntity)->toArray(), true);
        $authDetailsTransfer->setAuthorizationStatus(
            $this->getStatusTransfer($this->getPaymentEntity($orderEntity)->getOrderReferenceStatus())
        );

        $captureDetailsTransfer = new AmazonpayCaptureDetailsTransfer();
        $captureDetailsTransfer->fromArray($this->getPaymentEntity($orderEntity)->toArray(), true);

        $refundDetailsTransfer = new AmazonpayRefundDetailsTransfer();
        $refundDetailsTransfer->fromArray($this->getPaymentEntity($orderEntity)->toArray(), true);

        $paymentTransfer->fromArray($this->getPaymentEntity($orderEntity)->toArray(), true);
        $paymentTransfer->setAuthorizationDetails($authDetailsTransfer);
        $paymentTransfer->setCaptureDetails($captureDetailsTransfer);
        $paymentTransfer->setRefundDetails($refundDetailsTransfer);

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
     * @param string $statusName
     *
     * @return AmazonpayStatusTransfer
     */
    protected function getStatusTransfer($statusName)
    {
        $amazonpayStatusTransfer = new AmazonpayStatusTransfer();

        $amazonpayStatusTransfer->setIsPending(
            $statusName === AmazonpayConstants::OMS_STATUS_AUTH_PENDING
        );

        $amazonpayStatusTransfer->setIsDeclined(
            $statusName === AmazonpayConstants::OMS_STATUS_AUTH_DECLINED ||
            $statusName === AmazonpayConstants::OMS_STATUS_AUTH_SUSPENDED
        );

        $amazonpayStatusTransfer->setIsSuspended(
            $statusName === AmazonpayConstants::OMS_STATUS_AUTH_SUSPENDED
        );

        $amazonpayStatusTransfer->setIsOpen(
            $statusName === AmazonpayConstants::OMS_STATUS_AUTH_OPEN
        );

        return $amazonpayStatusTransfer;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomer
     */
    protected function getCustomerEntity(SpySalesOrder $orderEntity)
    {
        return $orderEntity->getCustomer();
    }

}
