<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Shared\Amazonpay\AmazonpayConstants;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class UpdateCaptureStatusCommandPlugin extends AbstractAmazonpayCommandPlugin
{
    /**
     * @inheritdoc
     */
    public function run(array $salesOrderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        if ($this->getPaymentEntity($orderEntity)->getOrderReferenceStatus()
            === AmazonpayConstants::OMS_STATUS_CAPTURE_PENDING
            && count($orderEntity->getItems()) === count($salesOrderItems)
        ) {
            $orderTransfer = $this->getOrderTransfer($orderEntity);
            $this->getFacade()->updateCaptureStatus($orderTransfer);
        }

        return [];
    }

}