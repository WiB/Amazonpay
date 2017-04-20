<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Shared\Amazonpay\AmazonpayConstants;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class UpdateSuspendedOrderCommandPlugin extends AbstractAmazonpayCommandPlugin
{

    /**
     * @inheritdoc
     */
    public function run(array $salesOrderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        // no partial reauthorize should be possible
        if ($this->getPaymentEntity($orderEntity)->getOrderReferenceStatus()
            === AmazonpayConstants::OMS_STATUS_PAYMENT_METHOD_CHANGED
            && count($orderEntity->getItems()) === count($salesOrderItems)) {
            $this->getFacade()->reauthorizeOrder($this->getOrderTransfer($orderEntity));
        }

        return [];
    }

}
