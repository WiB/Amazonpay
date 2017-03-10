<?php
namespace Spryker\Zed\Amazonpay\Business;

use Generated\Shared\Transfer\OrderTransfer;
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
        return $this->getFactory()->createConfirmPurchaseTransactionHandlerCollection()->execute($quoteTransfer);
    }

    /**
     * @param OrderTransfer $orderTransfer
     *
     * @return OrderTransfer
     */
    public function authorizeOrder(OrderTransfer $orderTransfer)
    {

    }

    public function cancelOrder(OrderTransfer $orderTransfer)
    {

    }
}
