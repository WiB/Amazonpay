<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;

abstract class AbstractQuoteTransaction extends AbstractTransaction implements QuoteTransactionInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        $this->apiResponse = $this->executionAdapter->call($quoteTransfer);
        $quoteTransfer->getAmazonpayPayment()->setResponseHeader($this->apiResponse->getHeader());
        $this->transactionsLogger->log($this->apiResponse->getHeader());

        return $quoteTransfer;
    }

}
