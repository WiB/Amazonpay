<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

use Generated\Shared\Transfer\OrderTransfer;

interface OrderMessageFactoryInterface
{

    /**
     * @param OrderTransfer $orderTransfer
     *
     * @return AbstractNotificationMessage
     */
    public function createFailedAuthMessage(OrderTransfer $orderTransfer);

}
