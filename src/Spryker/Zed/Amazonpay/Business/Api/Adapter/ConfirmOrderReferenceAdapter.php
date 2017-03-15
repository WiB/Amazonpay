<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\ConfirmOrderReferenceAmazonpayResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ConfirmOrderReferenceAdapter extends AbstractQuoteAdapter
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return ConfirmOrderReferenceAmazonpayResponseTransfer
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->confirmOrderReference([
            'amazon_order_reference_id' => $quoteTransfer->getAmazonPayment()->getOrderReferenceId(),
            'amount' => $this->getAmount($quoteTransfer),
        ]);

        return $this->converter->convert($result);
    }
}
