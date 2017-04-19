<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Shared\Amazonpay\AmazonpayConstants;

class ReauthorizeOrderTransaction extends AbstractOrderTransaction
{

    /**
     * @var \Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer
     */
    protected $apiResponse;

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function execute(OrderTransfer $orderTransfer)
    {
        $orderTransfer->getAmazonpayPayment()->setRefundReferenceId(
            $this->generateOperationReferenceId($orderTransfer)
        );

        $orderTransfer = parent::execute($orderTransfer);

        if ($this->apiResponse->getHeader()->getIsSuccess()) {
            $orderTransfer->getAmazonpayPayment()->setAuthorizationDetails(
                $this->apiResponse->getAuthorizationDetails()
            );

            $this->paymentEntity->setAmazonAuthorizationId($this->apiResponse->getAuthorizationDetails()->getAmazonAuthorizationId());
            $this->paymentEntity->setAuthorizationReferenceId($this->apiResponse->getAuthorizationDetails()->getAuthorizationReferenceId());
            $this->paymentEntity->save();
        }

        if ($orderTransfer->getAmazonpayPayment()->getAuthorizationDetails()->getAuthorizationStatus()->getIsSuspended()) {
            $this->paymentEntity->setOrderReferenceStatus(AmazonpayConstants::OMS_STATUS_AUTH_SUSPENDED);
        } elseif ($orderTransfer->getAmazonpayPayment()->getAuthorizationDetails()->getAuthorizationStatus()->getIsDeclined()) {
            $this->paymentEntity->setOrderReferenceStatus(AmazonpayConstants::OMS_STATUS_AUTH_DECLINED);
        }  elseif ($orderTransfer->getAmazonpayPayment()->getAuthorizationDetails()->getAuthorizationStatus()->getIsPending()) {
            $this->paymentEntity->setOrderReferenceStatus(AmazonpayConstants::OMS_STATUS_AUTH_PENDING);
        } elseif ($orderTransfer->getAmazonpayPayment()->getAuthorizationDetails()->getAuthorizationStatus()->getIsOpen()) {
            $this->paymentEntity->setOrderReferenceStatus(AmazonpayConstants::OMS_STATUS_AUTH_OPEN);
        }

        $this->paymentEntity->save();

        return $orderTransfer;
    }

}
