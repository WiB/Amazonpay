<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\AuthorizeOrderAmazonpayResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class AuthorizeOrderAdapter extends AbstractQuoteAdapter
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return AuthorizeOrderAmazonpayResponseTransfer
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->authorize([
            'amazon_order_reference_id' => $quoteTransfer->getAmazonpayPayment()->getOrderReferenceId(),
            'authorization_amount' => $this->getAmount($quoteTransfer),
            'authorization_reference_id' => $quoteTransfer->getAmazonpayPayment()->getAuthorizationReferenceId(),
            'transaction_timeout' => 0,
            'capture_now' => true,
        ]);

        return $this->converter->convert($result);
    }

}
