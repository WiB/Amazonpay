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
            'amazon_order_reference_id' => $quoteTransfer->getAmazonPayment()->getOrderReferenceId(),
            'amount' => $this->getAmount($quoteTransfer),
        ]);

        return $this->converter->convert($result);
    }
}