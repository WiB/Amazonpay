<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Shared\Amazonpay\AmazonpayConstants;

class CaptureOrderTransaction extends AbstractOrderTransaction
{

    /**
     * @var \Generated\Shared\Transfer\AmazonpayCaptureOrderResponseTransfer
     */
    protected $apiResponse;

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function execute(OrderTransfer $orderTransfer)
    {
        if (!$orderTransfer->getAmazonpayPayment()->getAuthorizationDetails()->getAuthorizationStatus()->getIsOpen()) {
            return $orderTransfer;
        }

        $orderTransfer->getAmazonpayPayment()->setCaptureReferenceId(
            $this->generateOperationReferenceId($orderTransfer)
        );

        $orderTransfer = parent::execute($orderTransfer);

        if ($orderTransfer->getAmazonpayPayment()->getResponseHeader()->getIsSuccess()) {
            $orderTransfer->getAmazonpayPayment()->setCaptureDetails(
                $this->apiResponse->getCaptureDetails()
            );

            $this->paymentEntity->setAmazonCaptureId($this->apiResponse->getCaptureDetails()->getAmazonCaptureId());
            $this->paymentEntity->setCaptureReferenceId($this->apiResponse->getCaptureDetails()->getCaptureReferenceId());
        }

        if ($orderTransfer->getAmazonpayPayment()->getCaptureDetails()->getCaptureStatus()->getIsDeclined()) {
            $this->paymentEntity->setOrderReferenceStatus(AmazonpayConstants::OMS_STATUS_CAPTURE_DECLINED);
        }  elseif ($orderTransfer->getAmazonpayPayment()->getCaptureDetails()->getCaptureStatus()->getIsPending()) {
            $this->paymentEntity->setOrderReferenceStatus(AmazonpayConstants::OMS_STATUS_CAPTURE_PENDING);
        } elseif ($orderTransfer->getAmazonpayPayment()->getCaptureDetails()->getCaptureStatus()->getIsCompleted()) {
            $this->paymentEntity->setOrderReferenceStatus(AmazonpayConstants::OMS_STATUS_CAPTURE_COMPLETED);
        }

        $this->paymentEntity->save();

        return $orderTransfer;
    }

}
