<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

class OrderFailedAuthNotificationSender implements OrderNotificationSenderInterface
{

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\AbstractNotificationMessage $notificationMessage
     *
     * @return void
     */
    public function notify(AbstractNotificationMessage $notificationMessage)
    {
    }

}
