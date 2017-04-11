<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;

use Spryker\Shared\Amazonpay\AmazonpayConstants;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface;

class IpnConverterFactory implements IpnConverterFactoryInterface
{

    /**
     * @param array $request
     *
     * @return ArrayConverterInterface
     */
    public function createIpnRequestConverter(array $request)
    {
        switch ($request['NotificationType'])
        {
            case AmazonpayConstants::IPN_REQUEST_TYPE_PAYMENT_AUTHORIZE:
                return new IpnPaymentAuthorizeRequestConverter();

            case AmazonpayConstants::IPN_REQUEST_TYPE_PAYMENT_CAPTURE:
                return new IpnPaymentCaptureRequestConverter();

            case AmazonpayConstants::IPN_REQUEST_TYPE_PAYMENT_REFUND:
                return new IpnPaymentRefundRequestConverter();
        }
    }
}
