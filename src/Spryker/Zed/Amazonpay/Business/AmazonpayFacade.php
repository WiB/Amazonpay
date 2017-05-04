<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business;

use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RefundTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @api
 *
 * @method \Spryker\Zed\Amazonpay\Business\AmazonpayBusinessFactory getFactory()
 */
class AmazonpayFacade extends AbstractFacade implements AmazonpayFacadeInterface
{

    /**
     *
     * @TODO CR specification is missing add inheridoc and move to interface
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function handleCartWithAmazonpay(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()
            ->createQuoteUpdateFactory()
            ->createQuoteDataInitializer()
            ->update($quoteTransfer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addSelectedAddressToQuote(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()
            ->createQuoteUpdateFactory()
            ->createShippingAddressQuoteDataUpdater()
            ->update($quoteTransfer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addSelectedShipmentMethodToQuote(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()
            ->createQuoteUpdateFactory()
            ->createShipmentDataQuoteUpdater()
            ->update($quoteTransfer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function confirmPurchase(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()
            ->createTransactionFactory()
            ->createConfirmPurchaseTransaction()
            ->execute($quoteTransfer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function captureOrder(OrderTransfer $orderTransfer)
    {
        return $this->getFactory()
            ->createTransactionFactory()
            ->createCaptureAuthorizedTransaction()
            ->execute($orderTransfer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function cancelOrder(OrderTransfer $orderTransfer)
    {
        return $this->getFactory()
            ->createTransactionFactory()
            ->createCancelOrderTransaction()
            ->execute($orderTransfer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function closeOrder(OrderTransfer $orderTransfer)
    {
        return $this->getFactory()
            ->createTransactionFactory()
            ->createCloseOrderTransaction()
            ->execute($orderTransfer);
    }

    /**
     * @api
     *
     * @param array $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     *
     * @return \Generated\Shared\Transfer\RefundTransfer
     */
    public function calculateRefund(array $salesOrderItems, SpySalesOrder $salesOrderEntity)
    {
        return $this->getFactory()
            ->getRefundFacade()
            ->calculateRefund($salesOrderItems, $salesOrderEntity);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     *
     * @return bool
     */
    public function saveRefund(RefundTransfer $refundTransfer)
    {
        return $this->getFactory()
            ->getRefundFacade()
            ->saveRefund($refundTransfer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function refundOrder(OrderTransfer $orderTransfer)
    {
        return $this->getFactory()
            ->createTransactionFactory()
            ->createRefundOrderTransaction()
            ->execute($orderTransfer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function reauthorizeExpiredOrder(OrderTransfer $orderTransfer)
    {
        return $this->getFactory()
            ->createTransactionFactory()
            ->createReauthorizeExpiredOrderTransaction()
            ->execute($orderTransfer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function reauthorizeSuspendedOrder(OrderTransfer $orderTransfer)
    {
        return $this->getFactory()
            ->createTransactionFactory()
            ->createReauthorizeSuspendedOrderTransaction()
            ->execute($orderTransfer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function updateAuthorizationStatus(OrderTransfer $orderTransfer)
    {
        return $this->getFactory()
            ->createTransactionFactory()
            ->createUpdateOrderAuthorizationStatusTransaction()
            ->execute($orderTransfer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function updateCaptureStatus(OrderTransfer $orderTransfer)
    {
        return $this->getFactory()
            ->createTransactionFactory()
            ->createUpdateOrderCaptureStatusTransaction()
            ->execute($orderTransfer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function updateRefundStatus(OrderTransfer $orderTransfer)
    {
        return $this->getFactory()
            ->createTransactionFactory()
            ->createUpdateOrderRefundStatusTransaction()
            ->execute($orderTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponseTransfer
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

    /**
     * @api
     *
     * @param array $headers
     * @param string $body
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    public function convertAmazonpayIpnRequest(array $headers, $body)
    {
        return $this->getFactory()
            ->createAdapterFactory()
            ->createIpnRequestAdapter($headers, $body)
            ->getIpnRequest();
    }

    /**
     * @api
     *
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $ipnRequestTransfer
     *
     * @return void
     */
    public function handleAmazonpayIpnRequest(AbstractTransfer $ipnRequestTransfer)
    {
        $this->getFactory()
            ->createIpnFactory()
            ->createIpnRequestFactory()
            ->createConcreteIpnRequestHandler($ipnRequestTransfer)
            ->handle($ipnRequestTransfer);
    }

}
