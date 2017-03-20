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

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function addSelectedAddressToQuote(QuoteTransfer $quoteTransfer);

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function addSelectedShipmentMethodToQuote(QuoteTransfer $quoteTransfer);

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return mixed
     */
    public function confirmPurchase(QuoteTransfer $quoteTransfer);

}
