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
        return md5 (__CLASS__ . $quoteTransfer->getAmazonPayment()->getAuthorizationReferenceId() . time());
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        // handling suspended case
        if ($quoteTransfer->getAmazonPayment()->getAuthorizationDetails()
            && $quoteTransfer->getAmazonPayment()->getAuthorizationDetails()->getIsPaymentMethodInvalid()
        ) {
            return $quoteTransfer;
        }

        $quoteTransfer->getAmazonPayment()->setSellerOrderId(
            $this->generateSellerIdForQuote($quoteTransfer)
        );

        return parent::execute($quoteTransfer);
    }

}
