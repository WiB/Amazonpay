<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface;

class OrderAuthFailedNotifyTransaction implements OrderTransactionInterface
{

    /**
     * @var OrderNotificationSenderInterface
     */
    protected $orderFailedAuthNotificationSender;

    /**
     * @var OrderMessageFactoryInterface
     */
    protected $orderMessageFactory;

    /**
     * @param OrderNotificationSenderInterface $orderFailedAuthNotificationSender
     * @param OrderMessageFactoryInterface $orderMessageFactory
     */
    public function __construct(
        OrderNotificationSenderInterface $orderFailedAuthNotificationSender,
        OrderMessageFactoryInterface $orderMessageFactory
    ) {
        $this->orderFailedAuthNotificationSender = $orderFailedAuthNotificationSender;
        $this->orderMessageFactory = $orderMessageFactory;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function execute(OrderTransfer $orderTransfer)
    {
        $message = $this->orderMessageFactory->createFailedAuthMessage($orderTransfer);

        if ($orderTransfer->getAmazonpayPayment()
                ->getAuthorizationDetails()
                ->getAuthorizationStatus()
                ->getIsDeclined()
        ) {
            $this->orderFailedAuthNotificationSender->notify($message);
        }

        return $orderTransfer;
    }
}
