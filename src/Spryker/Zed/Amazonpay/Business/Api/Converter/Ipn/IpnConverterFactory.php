<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;

use Exception;
use Spryker\Shared\Amazonpay\AmazonpayConstants;
use Spryker\Zed\Amazonpay\Business\Api\Converter\Details\AuthorizationDetailsConverter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\Details\CaptureDetailsConverter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\Details\RefundDetailsConverter;

class IpnConverterFactory implements IpnConverterFactoryInterface
{

    /**
     * @param array $request
     *
     * @throws \Exception
     *
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface
     */
    public function createIpnRequestConverter(array $request)
    {
        switch ($request['NotificationType'])
        {
            case AmazonpayConstants::IPN_REQUEST_TYPE_PAYMENT_AUTHORIZE:
                return new IpnPaymentAuthorizeRequestConverter(
                    new AuthorizationDetailsConverter()
                );

            case AmazonpayConstants::IPN_REQUEST_TYPE_PAYMENT_CAPTURE:
                return new IpnPaymentCaptureRequestConverter(
                    new CaptureDetailsConverter()
                );

            case AmazonpayConstants::IPN_REQUEST_TYPE_PAYMENT_REFUND:
                return new IpnPaymentRefundRequestConverter(
                    new RefundDetailsConverter()
                );

            case AmazonpayConstants::IPN_REQUEST_TYPE_ORDER_REFERENCE_NOTIFICATION:
                return new IpnOrderReferenceNotificationConverter();
        }

        throw new Exception('Unknown notification type: ' . $request['NotificationType']);
    }

}
