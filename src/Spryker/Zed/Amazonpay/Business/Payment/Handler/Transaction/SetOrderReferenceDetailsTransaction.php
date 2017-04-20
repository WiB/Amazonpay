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
     * @param \Generated\Shared\Transfer\QuoteTransfer $abstractTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function execute(QuoteTransfer $abstractTransfer)
    {
        // handling suspended case
        if ($abstractTransfer->getAmazonpayPayment()
            && $abstractTransfer->getAmazonpayPayment()->getAuthorizationDetails()
            && $abstractTransfer->getAmazonpayPayment()->getAuthorizationDetails()->getIsPaymentMethodInvalid()
        ) {
            return $abstractTransfer;
        }

        $abstractTransfer->getAmazonpayPayment()->setSellerOrderId(
            $this->generateOperationReferenceId($abstractTransfer)
        );

        return parent::execute($abstractTransfer);
    }

}
