<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;

interface QuoteTransactionInterface
{
    public function execute(QuoteTransfer $quoteTransfer);
}