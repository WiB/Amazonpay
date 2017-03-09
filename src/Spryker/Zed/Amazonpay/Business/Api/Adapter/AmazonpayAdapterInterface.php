<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;

interface AmazonpayAdapterInterface
{
    /**
     * @param QuoteTransfer $quoteTransfer
     */
    public function call(QuoteTransfer $quoteTransfer);

}