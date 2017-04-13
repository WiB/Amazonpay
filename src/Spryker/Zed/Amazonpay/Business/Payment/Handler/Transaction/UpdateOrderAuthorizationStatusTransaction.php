<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Shared\Amazonpay\AmazonpayConstants;

class UpdateOrderAuthorizationStatusTransaction extends AbstractOrderTransaction
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
        $orderTransfer = parent::execute($orderTransfer);

        if ($this->apiResponse->getHeader()->getIsSuccess()) {
            if ($this->apiResponse->getAuthorizationDetails()->getAuthorizationStatus()->getIsPending()) {
                return $orderTransfer;
            }

            if ($this->apiResponse->getAuthorizationDetails()->getAuthorizationStatus()->getIsDeclined()) {
                $this->paymentEntity->setOrderReferenceStatus(AmazonpayConstants::OMS_STATUS_AUTH_DECLINED);
            }

            if ($this->apiResponse->getAuthorizationDetails()->getAuthorizationStatus()->getIsOpen()) {
                $this->paymentEntity->setOrderReferenceStatus(AmazonpayConstants::OMS_STATUS_AUTH_OPEN);
            }

            if ($this->apiResponse->getAuthorizationDetails()->getAuthorizationStatus()->getIsClosed()) {
                $this->paymentEntity->setOrderReferenceStatus(AmazonpayConstants::OMS_STATUS_AUTH_CLOSED);
            }

            $this->paymentEntity->save();
        }

        return $orderTransfer;
    }

}
