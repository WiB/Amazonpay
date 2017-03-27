<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;


use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\RefundOrderAmazonpayResponseTransfer;

class RefundOrderAdapter extends AbstractOrderAdapter
{
    /**
     * @param OrderTransfer $orderTransfer
     *
     * @return RefundOrderAmazonpayResponseTransfer
     */
    public function call(OrderTransfer $orderTransfer)
    {
        $refundAmount = $this->moneyFacade->convertIntegerToDecimal(
            $orderTransfer->getTotals()->getRefundTotal()
        );

        $result = $this->client->refund([
            'amazon_order_reference_id' => $orderTransfer->getAmazonpayPayment()->getOrderReferenceId(),
            'amazon_capture_id' => $orderTransfer->getAmazonpayPayment()->getCaptureId(),
            'refund_reference_id' => $orderTransfer->getAmazonpayPayment()->getRefundReferenceId(),
            'refund_amount' => $refundAmount
        ]);

        return $this->converter->convert($result);
    }

}
