<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\Amazonpay;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Spryker\Client\Amazonpay\AmazonpayFactory getFactory()
 */
class AmazonpayClient extends AbstractClient implements AmazonpayClientInterface
{

    /**
     * Set initial order data to quote
     *
     * @api
     *
     * @method \Spryker\Client\Amazonpay\AmazonpayFactory getFactory()
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function handleCartWithAmazonpay(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()->createZedStub()->handleCartWithAmazonpay($quoteTransfer);
    }

    /**
     * Handles address selection
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addSelectedAddressToQuote(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()->createZedStub()->addSelectedAddressToQuote($quoteTransfer);
    }

    /**
     * Handles shipment method selection
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addSelectedShipmentMethodToQuote(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()->createZedStub()->addSelectedShipmentMethodToQuote($quoteTransfer);
    }

    /**
     * Places an order
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function confirmPurchase(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()->createZedStub()->confirmPurchase($quoteTransfer);
    }

    public function handleIpnRequest()
    {

    }

}
