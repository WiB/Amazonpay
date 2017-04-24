<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;

class HandleDeclinedOrderTransaction extends AbstractQuoteTransaction
{

    const ORDER_REFERENCE_STATUS_OPEN = 'Open';

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\GetOrderReferenceDetailsTransaction
     */
    protected $getOrderReferenceDetailsTransaction;

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\CancelOrderTransaction
     */
    protected $cancelOrderTransaction;

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\GetOrderReferenceDetailsTransaction $getOrderReferenceDetailsTransaction
     * @param \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\CancelOrderTransaction $cancelOrderTransaction
     */
    public function __construct(
        GetOrderReferenceDetailsTransaction $getOrderReferenceDetailsTransaction,
        CancelOrderTransaction $cancelOrderTransaction
    ) {
        $this->getOrderReferenceDetailsTransaction = $getOrderReferenceDetailsTransaction;
        $this->cancelOrderTransaction = $cancelOrderTransaction;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $abstractTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function execute(QuoteTransfer $abstractTransfer)
    {
        if (!$abstractTransfer->getAmazonpayPayment()->getAuthorizationDetails()->getAuthorizationStatus()->getIsDeclined()) {
            return $abstractTransfer;
        }

        if ($abstractTransfer->getAmazonpayPayment()
                ->getAuthorizationDetails()
                ->getAuthorizationStatus()
                ->getIsPaymentMethodInvalid()
        ) {
            return $abstractTransfer;
        }

        $checkOrderStatus = $this->getOrderReferenceDetailsTransaction->execute($abstractTransfer);

        //@todo should be  $checkOrderStatus->getAmazonpayPayment()->getOrderReferenceStatus()->isOpen instead
        if ($checkOrderStatus->getAmazonpayPayment()->getOrderReferenceStatus() === self::ORDER_REFERENCE_STATUS_OPEN) {
            $this->cancelOrderTransaction->execute($abstractTransfer);
        }

        return $abstractTransfer;
    }

}
