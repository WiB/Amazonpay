<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\CloseOrderAmazonpayResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Shared\Amazonpay\AmazonpayConstants;

class CloseOrderTransaction extends AbstractOrderTransaction
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
    public function execute(OrderTransfer $orderTransfer)
    {
        $orderTransfer = parent::execute($orderTransfer);

        if ($this->apiResponse->getHeader()->getIsSuccess()) {
            $this->paymentEntity->setOrderReferenceStatus(AmazonpayConstants::OMS_STATUS_CLOSED);
            $this->paymentEntity->save();
        }

        return $orderTransfer;
    }

}
