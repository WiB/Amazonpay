<?php
namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Condition;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Shared\Amazonpay\AmazonpayConstants;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Condition\ConditionInterface;

class IsRefundedConditionPlugin implements ConditionInterface
{
    /**
     * @param SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function check(SpySalesOrderItem $orderItem)
    {
        return $orderItem->getOrder()->getSpyPaymentAmazonpays()->getFirst()->getOrderReferenceStatus()
                    === AmazonpayConstants::OMS_STATUS_REFUNDED;
    }
}