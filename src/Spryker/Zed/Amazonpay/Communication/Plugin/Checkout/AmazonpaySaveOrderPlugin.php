<?php
namespace Spryker\Zed\Amazonpay\Communication\Plugin\Checkout;

use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Checkout\Dependency\Plugin\CheckoutSaveOrderInterface;

/**
 * @method \Spryker\Zed\Amazonpay\Business\AmazonpayFacade getFacade()
 * @method \Spryker\Zed\Amazonpay\Communication\AmazonpayCommunicationFactory getFactory()
 */
class AmazonpaySaveOrderPlugin extends AbstractPlugin implements CheckoutSaveOrderInterface
{

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponse
     *
     * @return void
     */
    public function saveOrder(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponse)
    {
        $this->getFacade()->saveOrderPayment($quoteTransfer, $checkoutResponse);
    }

}
