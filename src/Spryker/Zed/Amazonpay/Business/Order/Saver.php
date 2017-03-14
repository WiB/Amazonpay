<?php
namespace Spryker\Zed\Amazonpay\Business\Order;

use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay;
use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayOrderItem;
use Spryker\Shared\Amazonpay\AmazonpayConstants;

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
        $paymentEntity = $this->savePaymentForOrder(
            $quoteTransfer->getPayment(),
            $checkoutResponseTransfer->getSaveOrder()
        );

        $this->savePaymentForOrderItems(
            $checkoutResponseTransfer->getSaveOrder()->getOrderItems(),
            $paymentEntity->getIdPaymentAmazonpay()
        );
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTransfer $paymentTransfer
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay
     */
    protected function savePaymentForOrder(PaymentTransfer $paymentTransfer, SaveOrderTransfer $saveOrderTransfer)
    {
        $paymentEntity = new SpyPaymentAmazonpay();
        // $paymentEntity->setRequestId($paymentTransfer)


        return $paymentEntity;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer[] $orderItemTransfers
     * @param int $idPayment
     *
     * @return void
     */
    protected function savePaymentForOrderItems($orderItemTransfers, $idPayment)
    {
        foreach ($orderItemTransfers as $orderItemTransfer) {
            $paymentOrderItemEntity = new SpyPaymentAmazonpayOrderItem();

            $paymentOrderItemEntity
                ->setFkPaymentAmazonpay($idPayment)
                ->setFkSalesOrderItem($orderItemTransfer->getIdSalesOrderItem());
            $paymentOrderItemEntity->setStatus(AmazonpayConstants::OMS_STATUS_NEW);

            $paymentOrderItemEntity->save();
        }
    }

}
