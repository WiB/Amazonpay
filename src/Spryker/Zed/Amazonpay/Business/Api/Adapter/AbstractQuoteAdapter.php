<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;

abstract class AbstractQuoteAdapter extends AbstractAdapter implements QuoteAdapterInterface
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return float
     */
    protected function getAmount(QuoteTransfer $quoteTransfer)
    {
        return $this->moneyFacade->convertIntegerToDecimal(
            $quoteTransfer->requireTotals()->getTotals()->getGrandTotal()
        );
    }

}
