<?php
namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Command;

use Spryker\Zed\Amazonpay\Business\AmazonpayFacade;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

/**
 * @method AmazonpayFacade getFacade()
 */
class CancelCommandPlugin extends AbstractAmazonpayCommandPlugin
{
    /**
     * @inheritdoc
     */
    public function run(array $salesOrderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        // $this->getFacade()->cancelOrder($orderTransfer);

        return [];
    }

}
