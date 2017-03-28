<?php
namespace Spryker\Zed\Amazonpay\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\RefundTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Generated\Shared\Transfer\CheckoutResponseTransfer;

/**
 * @method \Spryker\Zed\Amazonpay\Business\AmazonpayBusinessFactory getFactory()
 */
interface AmazonpayFacadeInterface
{
    public function handleCartWithAmazonpay(QuoteTransfer $quoteTransfer);

    public function addSelectedAddressToQuote(QuoteTransfer $quoteTransfer);

    public function addSelectedShipmentMethodToQuote(QuoteTransfer $quoteTransfer);

    public function confirmPurchase(QuoteTransfer $quoteTransfer);

    public function closeOrder(OrderTransfer $orderTransfer);

    public function calculateRefund(array $salesOrderItems, SpySalesOrder $salesOrderEntity);

    public function saveRefund(RefundTransfer $refundTransfer);

    public function refundOrder(OrderTransfer $orderTransfer);

    public function saveOrderPayment(
        QuoteTransfer $quoteTransfer,
        CheckoutResponseTransfer $checkoutResponseTransfer
    );
}
