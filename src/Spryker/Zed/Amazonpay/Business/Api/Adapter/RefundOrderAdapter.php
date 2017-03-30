<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\OrderTransfer;

class RefundOrderAdapter extends AbstractOrderAdapter
{
    const AMAZON_CAPTURE_ID = 'amazon_capture_id';
    const REFUND_REFERENCE_ID = 'refund_reference_id';
    const REFUND_AMOUNT = 'refund_amount';

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\AmazonpayRefundOrderResponseTransfer
     */
    public function call(OrderTransfer $orderTransfer)
    {
        $refundAmount = $this->moneyFacade->convertIntegerToDecimal(
            $orderTransfer->getTotals()->getRefundTotal()
        );

        $result = $this->client->refund([
            AbstractAdapter::AMAZON_ORDER_REFERENCE_ID => $orderTransfer->getAmazonpayPayment()->getOrderReferenceId(),
            static::AMAZON_CAPTURE_ID => $orderTransfer->getAmazonpayPayment()->getCaptureId(),
            static::REFUND_REFERENCE_ID => $orderTransfer->getAmazonpayPayment()->getRefundReferenceId(),
            static::REFUND_AMOUNT => $refundAmount,
        ]);

        return $this->converter->convert($result);
    }

}
