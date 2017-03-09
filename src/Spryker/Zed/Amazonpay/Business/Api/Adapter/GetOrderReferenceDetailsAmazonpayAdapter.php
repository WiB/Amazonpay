<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;
use PayWithAmazon\ResponseParser;

class GetOrderReferenceDetailsAmazonpayAdapter extends AbstractAmazonpayAdapter
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return ResponseParser
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->getOrderReferenceDetails([
            'amazon_order_reference_id' => $quoteTransfer->getAmazonOrderReferenceId(),
            'address_consent_token' => $quoteTransfer->getAmazonAddressConsentToken(),
        ]);

        return $this->converter->toTransactionResponseTransfer($result);
    }

}