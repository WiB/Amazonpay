<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

use Generated\Shared\Transfer\OrderTransfer;

class OrderAuthFailedSoftDeclineMessage extends AbstractNotificationMessage
{

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     */
    public function __construct(OrderTransfer $orderTransfer)
    {
    }

}
