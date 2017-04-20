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
     * @param \Generated\Shared\Transfer\QuoteTransfer $abstractTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function execute(QuoteTransfer $abstractTransfer)
    {
        foreach ($this->transactionHandlers as $transactionHandler) {
            $abstractTransfer = $transactionHandler->execute($abstractTransfer);

            if (!$abstractTransfer->getAmazonpayPayment()->getResponseHeader()->getIsSuccess()) {
                return $abstractTransfer;
            }
        }

        return $abstractTransfer;
    }

}
