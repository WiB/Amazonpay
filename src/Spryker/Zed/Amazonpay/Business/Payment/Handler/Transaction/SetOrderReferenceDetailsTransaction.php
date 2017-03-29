<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;

class SetOrderReferenceDetailsTransaction extends AbstractQuoteTransaction
{

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function generateSellerIdForQuote(QuoteTransfer $quoteTransfer)
    {
        return md5(__CLASS__ . $quoteTransfer->getAmazonpayPayment()->getAuthorizationReferenceId() . time());
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        // handling suspended case
        if ($quoteTransfer->getAmazonpayPayment()
            && $quoteTransfer->getAmazonpayPayment()->getAuthorizationDetails()
            && $quoteTransfer->getAmazonpayPayment()->getAuthorizationDetails()->getIsPaymentMethodInvalid()
        ) {
            return $quoteTransfer;
        }

        $quoteTransfer->getAmazonpayPayment()->setSellerOrderId(
            $this->generateSellerIdForQuote($quoteTransfer)
        );

        return parent::execute($quoteTransfer);
    }

}
