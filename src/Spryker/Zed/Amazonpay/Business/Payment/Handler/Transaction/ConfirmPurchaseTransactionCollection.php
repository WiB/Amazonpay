<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;

class ConfirmPurchaseTransactionCollection extends AbstractQuoteTransaction
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\AbstractQuoteTransaction[]
     */
    protected $transactionHandlers;

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\AbstractQuoteTransaction[] $transactionHandlers
     */
    public function __construct(
        array $transactionHandlers
    ) {
        $this->transactionHandlers = $transactionHandlers;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        foreach ($this->transactionHandlers as $transactionHandler) {
            $quoteTransfer = $transactionHandler->execute($quoteTransfer);

            if (!$quoteTransfer->getAmazonpayPayment()->getResponseHeader()->getIsSuccess()) {
                return $quoteTransfer;
            }
        }

        return $quoteTransfer;
    }

}
