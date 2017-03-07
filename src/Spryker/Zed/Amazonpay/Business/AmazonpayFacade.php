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
}
