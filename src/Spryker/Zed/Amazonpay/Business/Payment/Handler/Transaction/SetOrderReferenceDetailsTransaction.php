<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;

class SetOrderReferenceDetailsTransaction extends AbstractQuoteTransaction
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    protected function generateSellerIdForQuote(QuoteTransfer $quoteTransfer)
    {
        return md5 (__CLASS__ . $quoteTransfer->getAmazonPayment()->getOrderReference() . time());
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        $quoteTransfer->getAmazonPayment()->setAuthorizationReferenceId(
            $this->generateSellerIdForQuote($quoteTransfer)
        );

        return parent::execute($quoteTransfer);
    }

}
