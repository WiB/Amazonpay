<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

interface OrderNotificationFactoryInterface
{

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface
     */
    public function createOrderAuthFailedTransaction();

}
