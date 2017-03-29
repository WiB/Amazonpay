<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Quote;

use Generated\Shared\Transfer\QuoteTransfer;

class PrepareQuoteCollection implements QuoteUpdaterInterface
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Quote\QuoteUpdaterInterface[]
     */
    protected $quoteUpdaters;

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Quote\QuoteUpdaterInterface[] $quoteUpdaters
     */
    public function __construct($quoteUpdaters)
    {
        $this->quoteUpdaters = $quoteUpdaters;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function update(QuoteTransfer $quoteTransfer)
    {
        foreach ($this->quoteUpdaters as $quoteUpdater) {
            $quoteTransfer = $quoteUpdater->update($quoteTransfer);
        }

        return $quoteTransfer;
    }

}
