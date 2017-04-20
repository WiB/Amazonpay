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
     * @var \Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer
     */
    protected $apiResponse;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $abstractTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function execute(QuoteTransfer $abstractTransfer)
    {
        $abstractTransfer->getAmazonpayPayment()->setAuthorizationReferenceId(
            $this->generateOperationReferenceId($abstractTransfer)
        );

        $abstractTransfer = parent::execute($abstractTransfer);

        if ($abstractTransfer->getAmazonpayPayment()->getResponseHeader()->getIsSuccess()) {
            $abstractTransfer->getAmazonpayPayment()->setAuthorizationDetails(
                $this->apiResponse->getAuthorizationDetails()
            );
        }

        return $abstractTransfer;
    }

}
