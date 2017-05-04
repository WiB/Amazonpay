<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\OrderTransfer;

class RefundOrderAdapter extends AbstractAdapter implements OrderAdapterInterface
{

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
            static::AMAZON_ORDER_REFERENCE_ID => $orderTransfer->getAmazonpayPayment()->getOrderReferenceId(),
            static::AMAZON_CAPTURE_ID =>
                $orderTransfer
                    ->getAmazonpayPayment()
                    ->getCaptureDetails()
                    ->getAmazonCaptureId(),
            static::REFUND_REFERENCE_ID =>
                $orderTransfer
                    ->getAmazonpayPayment()
                    ->getRefundDetails()
                    ->getRefundReferenceId(),
            static::REFUND_AMOUNT => $refundAmount,
        ]);

        return $this->converter->convert($result);
    }

}
