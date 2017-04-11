<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;

use Generated\Shared\Transfer\AmazonpayIpnPaymentRefundRequestTransfer;
use Generated\Shared\Transfer\AmazonpayRefundDetailsTransfer;

class IpnPaymentRefundRequestConverter extends IpnPaymentAbstractRequestConverter
{
    /**
     * @param array $request
     *
     * @return \Generated\Shared\Transfer\AmazonpayIpnPaymentRefundRequestTransfer
     */
    public function convert(array $request)
    {
        $ipnPaymentRefundRequestTransfer = new AmazonpayIpnPaymentRefundRequestTransfer();
        $ipnPaymentRefundRequestTransfer->setMessage($this->extractMessage($request));

        $refundDetailsTransfer = new AmazonpayRefundDetailsTransfer();
        $refundDetailsTransfer->fromArray($request['RefundDetails'], true);

        $ipnPaymentRefundRequestTransfer->setRefundDetails($refundDetailsTransfer);

        return $ipnPaymentRefundRequestTransfer;
    }

}
