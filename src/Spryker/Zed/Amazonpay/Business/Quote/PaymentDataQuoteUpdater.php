<?php
namespace Spryker\Zed\Amazonpay\Business\Quote;

use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Amazonpay\AmazonpayConstants;

class PaymentDataQuoteUpdater implements QuoteUpdaterInterface
{
    /**
     * @param QuoteTransfer $quoteTransfer
     * 
     * @return QuoteTransfer
     */
    public function update(QuoteTransfer $quoteTransfer)
    {
        $paymentTransfer = new PaymentTransfer();
        $paymentTransfer->setPaymentMethod(AmazonpayConstants::PAYMENT_METHOD);
        $paymentTransfer->setPaymentProvider(AmazonpayConstants::PAYMENT_METHOD);
        $paymentTransfer->setPaymentSelection(AmazonpayConstants::PAYMENT_METHOD);
        $quoteTransfer->setPayment($paymentTransfer);

        return $quoteTransfer;
    }
}