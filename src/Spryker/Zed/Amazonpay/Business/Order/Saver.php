<?php
namespace Spryker\Zed\Amazonpay\Business\Order;

use Generated\Shared\Transfer\AmazonpayPaymentTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay;
use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayOrderItem;

class Saver implements SaverInterface
{

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponseTransfer
     *
     * @return void
     */
    public function saveOrderPayment(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponseTransfer)
    {
        $this->savePaymentForOrder(
            $quoteTransfer->getAmazonpayPayment(),
            $checkoutResponseTransfer->getSaveOrder()
        );
    }

    /**
     * @param AmazonpayPaymentTransfer $paymentTransfer
     * @param SaveOrderTransfer $saveOrderTransfer
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay
     */
    protected function savePaymentForOrder(AmazonpayPaymentTransfer $paymentTransfer, SaveOrderTransfer $saveOrderTransfer)
    {
        $paymentEntity = new SpyPaymentAmazonpay();
        $paymentEntity->setOrderReferenceId($paymentTransfer->getOrderReferenceId());
        $paymentEntity->setOrderReferenceStatus($paymentTransfer->getOrderReferenceStatus());
        $paymentEntity->setSellerOrderId($paymentTransfer->getSellerOrderId());
        $paymentEntity->setAuthorizationReference($paymentTransfer->getAuthorizationReferenceId());
        $paymentEntity->setAuthorizationId($paymentTransfer->getAuthorizationDetails()->getAuthorizationId());
        $paymentEntity->setFkSalesOrder($saveOrderTransfer->getIdSalesOrder());
        $paymentEntity->setRequestId($paymentTransfer->getResponseHeader()->getRequestId());
        $paymentEntity->save();

        return $paymentEntity;
    }

}
