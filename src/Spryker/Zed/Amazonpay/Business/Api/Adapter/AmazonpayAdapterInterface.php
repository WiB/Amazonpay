<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;
use PayWithAmazon\ResponseParser;

interface AmazonpayAdapterInterface
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return ResponseParser
     */
    public function setOrderReferenceDetails(QuoteTransfer $quoteTransfer);

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return ResponseParser
     */
    public function confirmOrderReference(QuoteTransfer $quoteTransfer);

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return ResponseParser
     */
    public function getOrderReferenceDetails(QuoteTransfer $quoteTransfer);
}