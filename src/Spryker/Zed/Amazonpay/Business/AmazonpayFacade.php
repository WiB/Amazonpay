<?php
namespace Spryker\Zed\Amazonpay\Business;

use Generated\Shared\Transfer\CheckoutResponseTransfer;
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
    public function handleCartWithAmazonpay(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()
            ->getQuoteUpdateFactory()
            ->createQuoteDataInitializer()
            ->update($quoteTransfer);
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function addSelectedAddressToQuote(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()
            ->getQuoteUpdateFactory()
            ->createShippingAddressQuoteDataUpdater()
            ->update($quoteTransfer);
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function addSelectedShipmentMethodToQuote(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()
            ->getQuoteUpdateFactory()
            ->createShipmentDataQuoteUpdater()
            ->update($quoteTransfer);
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function confirmPurchase(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()
            ->getTransactionFactory()
            ->createConfirmPurchaseTransactionCollection()
            ->execute($quoteTransfer);
    }

    /**
     * @param OrderTransfer $orderTransfer
     *
     * @return OrderTransfer
     */
    public function closeOrder(OrderTransfer $orderTransfer)
    {
        return $this->getFactory()
            ->getTransactionFactory()
            ->createCloseOrderTransaction()
            ->execute($orderTransfer);
    }

    /**
     * @param OrderTransfer $orderTransfer
     *
     * @return OrderTransfer
     */
    public function refundOrder(OrderTransfer $orderTransfer)
    {
        return $this->getFactory()
            ->getTransactionFactory()
            ->createRefundOrderTransaction()
            ->execute($orderTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param QuoteTransfer $quoteTransfer
     * @param CheckoutResponseTransfer $checkoutResponseTransfer
     *
     * @return void
     */
    public function saveOrderPayment(
        QuoteTransfer $quoteTransfer,
        CheckoutResponseTransfer $checkoutResponseTransfer
    ) {
        $this
            ->getFactory()
            ->createOrderSaver()
            ->saveOrderPayment($quoteTransfer, $checkoutResponseTransfer);
    }

}
