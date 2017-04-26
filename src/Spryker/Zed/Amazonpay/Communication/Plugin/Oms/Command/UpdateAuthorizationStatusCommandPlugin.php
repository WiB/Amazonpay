<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Shared\Amazonpay\AmazonpayConstants;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class UpdateAuthorizationStatusCommandPlugin extends AbstractAmazonpayCommandPlugin
{

    /**
     * @inheritdoc
     */
    public function run(array $salesOrderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        echo 'trggered' . PHP_EOL;

        if (count($orderEntity->getItems()) === count($salesOrderItems)) {
            $orderTransfer = $this->getOrderTransfer($orderEntity);
            $this->getFacade()->updateAuthorizationStatus($orderTransfer);
        } else {
            echo count($salesOrderItems) . PHP_EOL;
        }

        return [];
    }

}
