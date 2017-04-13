<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\OrderTransfer;

class CaptureOrderAdapter extends AbstractOrderAdapter
{

    const CAPTURE_REFERENCE_ID = 'capture_reference_id';
    const CAPTURE_AMOUNT = 'capture_amount';

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer
     */
    public function call(OrderTransfer $orderTransfer)
    {
        $result = $this->client->capture([
            static::AMAZON_AUTHORIZATION_ID =>
                $orderTransfer->getAmazonpayPayment()
                    ->getAuthorizationDetails()
                    ->getAmazonAuthorizationId(),
            static::CAPTURE_REFERENCE_ID =>
                $orderTransfer->getAmazonpayPayment()
                    ->getCaptureReferenceId(),
            static::CAPTURE_AMOUNT => $this->getAmount($orderTransfer),
            'SellerCaptureNote' => '{"SandboxSimulation": {"State":"Pending"}}'
        ]);

        return $this->converter->convert($result);
    }

}
