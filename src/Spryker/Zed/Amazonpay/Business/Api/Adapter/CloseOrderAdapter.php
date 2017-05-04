<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\OrderTransfer;

class CloseOrderAdapter extends AbstractAdapter implements OrderAdapterInterface
{

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\AmazonpayCloseOrderResponseTransfer
     */
    public function call(OrderTransfer $orderTransfer)
    {
        $result = $this->client->closeOrderReference([
            AbstractAdapter::AMAZON_ORDER_REFERENCE_ID => $orderTransfer->getAmazonpayPayment()->getOrderReferenceId(),
        ]);

        return $this->converter->convert($result);
    }

}
