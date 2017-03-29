<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\OrderTransfer;

class RefundOrderAdapter extends AbstractOrderAdapter
{

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\RefundOrderAmazonpayResponseTransfer
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
            'refund_amount' => $refundAmount,
        ]);

        return $this->converter->convert($result);
    }

}
