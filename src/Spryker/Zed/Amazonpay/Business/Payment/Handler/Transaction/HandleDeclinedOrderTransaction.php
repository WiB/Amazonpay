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
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        if (!$quoteTransfer->getAmazonpayPayment()->getAuthorizationDetails()->getAuthorizationStatus()->getIsDeclined()) {
            return $quoteTransfer;
        }

        if ($quoteTransfer->getAmazonpayPayment()->getAuthorizationDetails()->getIsPaymentMethodInvalid()) {
            return $quoteTransfer;
        }

        $checkOrderStatus = $this->getOrderReferenceDetailsTransaction->execute($quoteTransfer);

        if ($checkOrderStatus->getAmazonpayPayment()->getOrderReferenceStatus() === self::ORDER_REFERENCE_STATUS_OPEN) {
            $this->cancelOrderTransaction->execute($quoteTransfer);
        }

        return $quoteTransfer;
    }

}
