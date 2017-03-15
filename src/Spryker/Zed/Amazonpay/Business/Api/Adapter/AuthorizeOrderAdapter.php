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
            'amazon_order_reference_id' => $quoteTransfer->getAmazonPayment()->getOrderReferenceId(),
            'authorization_amount' => $quoteTransfer->getTotals()->getGrandTotal(),
            'authorization_reference_id' => $quoteTransfer->getAmazonPayment()->getAuthorizationReferenceId(),
            'transaction_timeout' => 0,
            'capture_now' => true,
        ]);

        return $this->converter->toTransactionResponseTransfer($result);
    }

}
