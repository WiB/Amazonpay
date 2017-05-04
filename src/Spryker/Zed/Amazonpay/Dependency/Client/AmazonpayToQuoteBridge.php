<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Dependency\Client;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\Quote\QuoteClientInterface;

class AmazonpayToQuoteBridge implements AmazonpayToQuoteInterface
{

    /**
     * @var \Spryker\Client\Quote\QuoteClientInterface
     */
    protected $quoteClient;

    /**
     * @param \Spryker\Client\Quote\QuoteClientInterface $quoteClient
     */
    public function __construct(QuoteClientInterface $quoteClient)
    {
        $this->quoteClient = $quoteClient;
    }

    /**
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function getQuote()
    {
        return $this->quoteClient->getQuote();
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return static
     */
    public function setQuote(QuoteTransfer $quoteTransfer)
    {
        $this->quoteClient->setQuote($quoteTransfer);

        return $this;
    }

    /**
     * @return void
     */
    public function clearQuote()
    {
        $this->quoteClient->clearQuote();
    }

}
