<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Dependency\Client;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\Cart\CartClientInterface;

class AmazonpayToCartBridge implements AmazonpayToCartInterface
{

    /**
     * @var \Spryker\Client\Cart\CartClientInterface
     */
    protected $cartClient;

    /**
     * @param \Spryker\Client\Cart\CartClientInterface $quoteClient
     */
    public function __construct(CartClientInterface $quoteClient)
    {
        $this->cartClient = $quoteClient;
    }

    /**
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function getQuote()
    {
        return $this->cartClient->getQuote();
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return static
     */
    public function setQuote(QuoteTransfer $quoteTransfer)
    {
        $this->cartClient->storeQuote($quoteTransfer);

        return $this;
    }

    /**
     * @return void
     */
    public function clearQuote()
    {
        $this->cartClient->clearQuote();
    }

}
