<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;

abstract class AbstractQuoteTransaction extends AbstractTransaction implements QuoteTransactionInterface
{

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string
     */
    protected function generateOperationReferenceId(QuoteTransfer $quoteTransfer)
    {
        return uniqid($quoteTransfer->getAmazonpayPayment()->getOrderReferenceId());
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        $this->apiResponse = $this->executionAdapter->call($quoteTransfer);
        $quoteTransfer->getAmazonpayPayment()->setResponseHeader($this->apiResponse->getHeader());
        $this->transactionsLogger->log(
            $quoteTransfer->getAmazonpayPayment()->getOrderReferenceId(),
            $this->apiResponse->getHeader()
        );

        return $quoteTransfer;
    }

}
