<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\CloseOrderAmazonpayResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Shared\Amazonpay\AmazonpayConstants;

class RefundOrderTransaction extends AbstractOrderTransaction
{
    /**
     * @var CloseOrderAmazonpayResponseTransfer
     */
    protected $apiResponse;

    /**
     * @param OrderTransfer $orderTransfer
     *
     * @return OrderTransfer
     */
    protected function generateRefundReferenceId(OrderTransfer $orderTransfer)
    {
        return md5 (__CLASS__ . $orderTransfer->getAmazonpayPayment()->getOrderReferenceId() . time());
    }

    /**
     * @param OrderTransfer $orderTransfer
     *
     * @return OrderTransfer
     */
    public function execute(OrderTransfer $orderTransfer)
    {
        $orderTransfer->getAmazonpayPayment()->setRefundReferenceId(
            $this->generateRefundReferenceId($orderTransfer)
        );
        
        $orderTransfer = parent::execute($orderTransfer);

        if ($this->apiResponse->getHeader()->getIsSuccess()) {
            $this->paymentEntity->setOrderReferenceStatus(AmazonpayConstants::OMS_STATUS_REFUNDED);
            $this->paymentEntity->save();
        }

        return $orderTransfer;
    }

}
