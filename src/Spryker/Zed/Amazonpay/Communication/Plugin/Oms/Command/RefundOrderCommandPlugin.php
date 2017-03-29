<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class RefundOrderCommandPlugin extends AbstractAmazonpayCommandPlugin
{

    /**
     * @inheritdoc
     */
    public function run(array $salesOrderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        $orderTransfer = $this->getOrderTransfer($orderEntity);
        $refundTransfer = $this->getFacade()
            ->calculateRefund($salesOrderItems, $orderEntity);

        $orderTransfer->getTotals()->setRefundTotal(
            $refundTransfer->getAmount()
        );

        $orderTransfer = $this->getFacade()->refundOrder($orderTransfer);

        if ($orderTransfer->getAmazonpayPayment()->getResponseHeader()->getIsSuccess()) {
            $this->getFacade()
                ->saveRefund($refundTransfer);
        }

        return [];
    }

}
