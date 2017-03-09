<?php
namespace Spryker\Zed\Amazonpay\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Spryker\Zed\Amazonpay\Business\AmazonpayBusinessFactory getFactory()
 */
class AmazonpayFacade extends AbstractFacade implements AmazonpayFacadeInterface
{
    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function updateQuote(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()->createQuoteDataUpdater()->update($quoteTransfer);
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function confirmPurchase(QuoteTransfer $quoteTransfer)
    {
        $response = $this->getFactory()->createSetOrderReferenceTransactionHandler()->execute($quoteTransfer);

        if (!$response->getHeader()->getIsSuccess()) {
            $quoteTransfer->setAmazonResponseHeader($response->getHeader());
            return $quoteTransfer;
        }

        $response = $this->getFactory()->createConfirmOrderReferenceTransactionHandler()->execute($quoteTransfer);

        if (!$response->getHeader()->getIsSuccess()) {
            $quoteTransfer->setAmazonResponseHeader($response->getHeader());
            return $quoteTransfer;
        }

        $response = $this->getFactory()->createGetOrderReferenceDetailsTransactionHandler()->execute($quoteTransfer);
        $quoteTransfer->setAmazonResponseHeader($response->getHeader());

        if ($response->getHeader()->getIsSuccess()) {
            $quoteTransfer->setShippingAddress($response->getAddress());
            $quoteTransfer->setBillingSameAsShipping(true);
        }

        return $quoteTransfer;
    }
}
