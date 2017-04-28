<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

use Generated\Shared\Transfer\OrderTransfer;

class OrderMessageFactory implements OrderMessageFactoryInterface
{

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\AbstractNotificationMessage
     */
    public function createFailedAuthMessage(OrderTransfer $orderTransfer)
    {
        if ($orderTransfer->getAmazonpayPayment()
            ->getAuthorizationDetails()
            ->getAuthorizationStatus()
            ->getIsSuspended()
        ) {
            return new OrderAuthFailedSoftDeclineMessage($orderTransfer);
        } elseif ($orderTransfer->getAmazonpayPayment()
            ->getAuthorizationDetails()
            ->getAuthorizationStatus()
            ->getIsDeclined()
        ) {
            return new OrderAuthFailedHardDeclineMessage($orderTransfer);
        }
    }

}
