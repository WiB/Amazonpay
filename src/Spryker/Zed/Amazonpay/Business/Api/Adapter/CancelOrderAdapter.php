<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\CancelOrderAmazonpayResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CancelOrderAdapter extends AbstractQuoteAdapter
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return CancelOrderAmazonpayResponseTransfer
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->authorize([
            'amazon_order_reference_id' => $quoteTransfer->getAmazonPayment()->getOrderReferenceId(),
            // 'authorization_reference_id' => $quoteTransfer->getAmazonPayment()->getAuthorizationReferenceId(),
        ]);

        return $this->converter->convert($result);
    }

}