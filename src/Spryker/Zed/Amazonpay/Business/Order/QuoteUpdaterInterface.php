<?php
namespace Spryker\Zed\Amazonpay\Business\Order;

use Generated\Shared\Transfer\QuoteTransfer;

interface QuoteUpdaterInterface
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function update(QuoteTransfer $quoteTransfer);
}