<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\GetOrderReferenceDetailsAmazonpayResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class GetOrderReferenceDetailsAdapter extends AbstractQuoteAdapter
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return GetOrderReferenceDetailsAmazonpayResponseTransfer
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->getOrderReferenceDetails([
            'amazon_order_reference_id' => $quoteTransfer->getAmazonPayment()->getOrderReferenceId(),
            'address_consent_token' => $quoteTransfer->getAmazonPayment()->getAddressConsentToken(),
        ]);

        return $this->converter->toTransactionResponseTransfer($result);
    }

}
