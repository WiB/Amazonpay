<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SetOrderReferenceDetailsAmazonpayResponseTransfer;

class SetOrderReferenceDetailsAdapter extends AbstractQuoteAdapter
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return SetOrderReferenceDetailsAmazonpayResponseTransfer
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->setOrderReferenceDetails([
            'amazon_order_reference_id' => $quoteTransfer->getAmazonpayPayment()->getOrderReferenceId(),
            'address_consent_token' => $quoteTransfer->getAmazonpayPayment()->getAddressConsentToken(),
            'amount' => $this->getAmount($quoteTransfer),
            'seller_order_id' => $quoteTransfer->getAmazonpayPayment()->getSellerOrderId(),
        ]);

        return $this->converter->convert($result);
    }
}