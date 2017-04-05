<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Condition;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Shared\Amazonpay\AmazonpayConstants;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Condition\ConditionInterface;

class IsRefundedConditionPlugin implements ConditionInterface
{

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function check(SpySalesOrderItem $orderItem)
    {
        return $orderItem->getOrder()->getSpyPaymentAmazonpays()->getFirst()->getOrderReferenceStatus()
                    === AmazonpayConstants::OMS_STATUS_REFUND_PENDING;
    }

}
