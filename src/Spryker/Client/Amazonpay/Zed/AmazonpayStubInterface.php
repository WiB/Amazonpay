<?php
namespace Spryker\Client\Amazonpay\Zed;

use Generated\Shared\Transfer\QuoteTransfer;

interface AmazonpayStubInterface
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function handleCartWithAmazonpay(QuoteTransfer $quoteTransfer);

}