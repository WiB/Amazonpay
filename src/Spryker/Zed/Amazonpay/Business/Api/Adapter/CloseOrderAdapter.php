<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\CloseOrderAmazonpayResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class CloseOrderAdapter extends AbstractOrderAdapter
{
    /**
     * @param OrderTransfer $orderTransfer
     *
     * @return CloseOrderAmazonpayResponseTransfer
     */
    public function call(OrderTransfer $orderTransfer)
    {
        $result = $this->client->closeOrderReference([
            'amazon_order_reference_id' => $orderTransfer->getAmazonpayPayment()->getOrderReferenceId(),
        ]);

        return $this->converter->convert($result);
    }

}
