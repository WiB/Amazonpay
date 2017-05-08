<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

class OrderNotificationFactory implements OrderNotificationFactoryInterface
{

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface
     */
    public function createOrderAuthFailedTransaction()
    {
        return new OrderAuthFailedNotifyTransaction(
            $this->createFailedAuthNotificationSender(),
            $this->createOrderMessageFactory()
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\OrderNotificationSenderInterface
     */
    protected function createFailedAuthNotificationSender()
    {
        return new OrderFailedAuthNotificationSender();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\OrderMessageFactoryInterface
     */
    protected function createOrderMessageFactory()
    {
        return new OrderMessageFactory();
    }

}
