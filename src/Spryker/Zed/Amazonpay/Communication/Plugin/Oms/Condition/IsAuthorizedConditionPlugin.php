<?php
namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Condition;

// use Orm\Zed\Amazonpay\Persistence\SpyPaymentBillpayOrderItem;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Condition\ConditionInterface;

class IsAuthorizedConditionPlugin implements ConditionInterface
{
    /**
     * @param SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function check(SpySalesOrderItem $orderItem)
    {
        return false;
    }
}