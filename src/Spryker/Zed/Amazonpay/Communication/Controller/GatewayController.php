<?php
namespace Spryker\Zed\Amazonpay\Communication\Controller;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Spryker\Zed\Amazonpay\Business\AmazonpayFacade getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function handleCartWithAmazonpayAction(QuoteTransfer $quoteTransfer)
    {
        return $this->getFacade()->handleCartWithAmazonpay($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function confirmPurchaseAction(QuoteTransfer $quoteTransfer)
    {
        return $this->getFacade()->confirmPurchase($quoteTransfer);
    }

}
