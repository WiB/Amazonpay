<?php

namespace Spryker\Client\Amazonpay;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Spryker\Client\Amazonpay\AmazonpayFactory getFactory()
 */
class AmazonpayClient extends AbstractClient implements AmazonpayClientInterface
{

    /**
     * Places the order
     *
     * @api
     *
     * @method AmazonpayFactory getFactory()
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function handleCartWithAmazonpay(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()->createZedStub()->handleCartWithAmazonpay($quoteTransfer);
    }

    public function confirmOrderReference(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()->createZedStub()->confirmOrderReference($quoteTransfer);
    }

}
