<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\GetOrderReferenceDetailsAmazonpayResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class GetOrderReferenceDetailsTransaction extends AbstractQuoteTransaction
{
    /**
     * @var GetOrderReferenceDetailsAmazonpayResponseTransfer
     */
    protected $apiResponse;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        $quoteTransfer = parent::execute($quoteTransfer);

        if ($quoteTransfer->getAmazonpayPayment()->getResponseHeader()->getIsSuccess()) {
            $quoteTransfer->setShippingAddress($this->apiResponse->getShippingAddress());

            if ($this->apiResponse->getBillingAddress()) {
                $quoteTransfer->setBillingAddress($this->apiResponse->getBillingAddress());
            } else {
                $quoteTransfer->setBillingAddress($this->apiResponse->getShippingAddress());
                $quoteTransfer->setBillingSameAsShipping(true);
            }

            $quoteTransfer->setOrderReference($quoteTransfer->getAmazonpayPayment()->getOrderReferenceId());
            $quoteTransfer->getAmazonpayPayment()->setOrderReferenceStatus($this->apiResponse->getOrderReferenceStatus());
        }

        return $quoteTransfer;
    }

}
