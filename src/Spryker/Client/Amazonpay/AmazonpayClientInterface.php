<?php
namespace Spryker\Client\Amazonpay;

use Generated\Shared\Transfer\QuoteTransfer;

interface AmazonpayClientInterface
{
    public function handleWithAmazonpay(QuoteTransfer $quoteTransfer);
}