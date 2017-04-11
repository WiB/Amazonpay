<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;

use Generated\Shared\Transfer\AmazonpayAuthorizationDetailsTransfer;
use Generated\Shared\Transfer\AmazonpayCaptureDetailsTransfer;
use Generated\Shared\Transfer\AmazonpayIpnPaymentAuthorizeRequestTransfer;
use Generated\Shared\Transfer\AmazonpayIpnPaymentCaptureRequestTransfer;
use Generated\Shared\Transfer\AmazonpayIpnPaymentRefundRequestTransfer;

class IpnPaymentCaptureRequestConverter extends IpnPaymentAbstractRequestConverter
{

    /**
     * @param array $request
     *
     * @return \Generated\Shared\Transfer\AmazonpayIpnPaymentCaptureRequestTransfer
     */
    public function convert(array $request)
    {
        $ipnPaymentCaptureRequestTransfer = new AmazonpayIpnPaymentCaptureRequestTransfer();
        $ipnPaymentCaptureRequestTransfer->setMessage($this->extractMessage($request));

        $captureDetailsTransfer = new AmazonpayCaptureDetailsTransfer();
        $captureDetailsTransfer->fromArray($request['CaptureDetails'], true);

        $ipnPaymentCaptureRequestTransfer->setCaptureDetails($captureDetailsTransfer);

        return $ipnPaymentCaptureRequestTransfer;
    }

}
