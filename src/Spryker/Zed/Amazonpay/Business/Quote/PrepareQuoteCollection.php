<?php
namespace Spryker\Zed\Amazonpay\Business\Quote;

use Generated\Shared\Transfer\QuoteTransfer;

class PrepareQuoteCollection implements QuoteUpdaterInterface
{
    protected $quoteUpdaters;

    /**
     * @param QuoteUpdaterInterface[] $quoteUpdaters
     */
    public function __construct($quoteUpdaters)
    {
        $this->quoteUpdaters = $quoteUpdaters;
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function update(QuoteTransfer $quoteTransfer)
    {
        foreach ($this->quoteUpdaters as $quoteUpdater) {
            $quoteTransfer = $quoteUpdater->update($quoteTransfer);
        }

        return $quoteTransfer;
    }
}