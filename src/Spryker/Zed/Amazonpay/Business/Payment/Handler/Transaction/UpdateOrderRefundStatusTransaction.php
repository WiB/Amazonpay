<?php


/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Shared\Amazonpay\AmazonpayConstants;

class UpdateOrderRefundStatusTransaction extends AbstractOrderTransaction
{

    /**
     * @var \Generated\Shared\Transfer\AmazonpayRefundOrderResponseTransfer
     */
    protected $apiResponse;

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function execute(OrderTransfer $orderTransfer)
    {
        if (!$orderTransfer->getAmazonpayPayment()->getRefundDetails()->getRefundStatus()->getIsPending()) {
            return $orderTransfer;
        }

        $orderTransfer = parent::execute($orderTransfer);

        if ($this->apiResponse->getHeader()->getIsSuccess()) {
            if ($this->apiResponse->getRefundDetails()->getRefundStatus()->getIsPending()) {
                return $orderTransfer;
            }

            if ($this->apiResponse->getRefundDetails()->getRefundStatus()->getIsDeclined()) {
                $this->paymentEntity->setStatus(AmazonpayConstants::OMS_STATUS_REFUND_DECLINED);
            }

            if ($this->apiResponse->getRefundDetails()->getRefundStatus()->getIsCompleted()) {
                $this->paymentEntity->setStatus(AmazonpayConstants::OMS_STATUS_REFUND_COMPLETED);
            }

            $this->paymentEntity->save();
        }

        return $orderTransfer;
    }

}
