<?php
namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class CloseOrderCommandPlugin extends AbstractAmazonpayCommandPlugin
{
    /**
     * @inheritdoc
     */
    public function run(array $salesOrderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        // no pratial closing should be possible
        if (sizeof($orderEntity->getItems()) === sizeof($salesOrderItems)) {
            $this->getFacade()->closeOrder($this->getOrderTransfer($orderEntity));
        }

        return [];
    }

}
