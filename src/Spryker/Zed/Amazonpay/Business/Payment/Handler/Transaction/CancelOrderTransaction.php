<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Shared\Amazonpay\AmazonpayConstants;

class CancelOrderTransaction extends AbstractOrderTransaction
{

    /**
     * @var \Generated\Shared\Transfer\AmazonpayCancelOrderResponseTransfer
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
            $this->paymentEntity->setOrderReferenceStatus(AmazonpayConstants::OMS_STATUS_CANCELLED);
            $this->paymentEntity->save();
        }

        return $orderTransfer;
    }

}
