<?php
namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use Spryker\Zed\Amazonpay\Business\AmazonpayFacade;

/**
 * @method AmazonpayFacade getFacade()
 */
class AuthorizeCommandPlugin extends AbstractAmazonpayCommandPlugin
{
    /**
     * @inheritdoc
     */
    public function run(array $salesOrderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        // $this->getFacade()->authorize($this->getOrderTransfer($orderEntity));

        return [];
    }

}
