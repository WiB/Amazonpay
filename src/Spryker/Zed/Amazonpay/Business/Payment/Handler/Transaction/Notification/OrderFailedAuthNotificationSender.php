<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
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
