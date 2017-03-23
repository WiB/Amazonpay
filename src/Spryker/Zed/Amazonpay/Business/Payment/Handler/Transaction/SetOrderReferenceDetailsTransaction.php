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
        return md5 (__CLASS__ . $quoteTransfer->getAmazonpayPayment()->getAuthorizationReferenceId() . time());
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        // handling suspended case
        if ($quoteTransfer->getAmazonpayPayment()
            && $quoteTransfer->getAmazonpayPayment()->getAuthorizationDetails()
            && $quoteTransfer->getAmazonpayPayment()->getAuthorizationDetails()->getIsPaymentMethodInvalid()
        ) {
            return $quoteTransfer;
        }

        $quoteTransfer->getAmazonpayPayment()->setSellerOrderId(
            $this->generateSellerIdForQuote($quoteTransfer)
        );

        return parent::execute($quoteTransfer);
    }

}
