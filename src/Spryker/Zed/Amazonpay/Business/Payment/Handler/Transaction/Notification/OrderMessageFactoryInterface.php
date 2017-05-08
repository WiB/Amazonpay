<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

use Generated\Shared\Transfer\OrderTransfer;

interface OrderMessageFactoryInterface
{

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\AbstractNotificationMessage
     */
    public function createFailedAuthMessage(OrderTransfer $orderTransfer);

}
