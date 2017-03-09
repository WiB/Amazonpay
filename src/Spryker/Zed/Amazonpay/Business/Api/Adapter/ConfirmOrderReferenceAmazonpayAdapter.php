<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;
use PayWithAmazon\ResponseParser;

class ConfirmOrderReferenceAmazonpayAdapter extends AbstractAmazonpayAdapter
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return ResponseParser
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->setOrderReferenceDetails([
            'amazon_order_reference_id' => $quoteTransfer->getAmazonOrderReferenceId(),
            'amount' => $quoteTransfer->getTotals()->getGrandTotal(),
        ]);

        return $this->converter->toTransactionResponseTransfer($result);
    }
}