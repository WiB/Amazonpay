<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;

class AuthorizeOrderTransaction extends AbstractQuoteTransaction
{

    /**
     * @var \Generated\Shared\Transfer\AuthorizeOrderAmazonpayResponseTransfer
     */
    protected $apiResponse;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function generateAuthorizationReferenceIdForQuote(QuoteTransfer $quoteTransfer)
    {
        return md5(__CLASS__ . $quoteTransfer->getAmazonpayPayment()->getOrderReferenceId() . time());
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        $quoteTransfer->getAmazonpayPayment()->setAuthorizationReferenceId(
            $this->generateAuthorizationReferenceIdForQuote($quoteTransfer)
        );

        $quoteTransfer = parent::execute($quoteTransfer);

        if ($quoteTransfer->getAmazonpayPayment()->getResponseHeader()->getIsSuccess()) {
            $quoteTransfer->getAmazonpayPayment()->setAuthorizationDetails(
                $this->apiResponse->getAuthorizationDetails()
            );
        }

        return $quoteTransfer;
    }

}
