<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

interface OrderNotificationSenderInterface
{
    /**
     * @param \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\AbstractNotificationMessage $message
     */
    public function notify(AbstractNotificationMessage $message);

}
