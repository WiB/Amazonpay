<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\AbstractPaymentHandler;

abstract class AbstractQuoteTransaction extends AbstractPaymentHandler implements QuoteTransactionInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        return $this->executionAdapter->call($quoteTransfer);
    }

}