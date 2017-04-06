<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;

use Generated\Shared\Transfer\AmazonAuthorizationDetailsTransfer;
use Generated\Shared\Transfer\AmazonpayIpnPaymentAuthorizeRequestTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractArrayConverter;

class IpnPaymentAuthorizeRequestConverter extends AbstractArrayConverter
{
    /**
     * @param array $request
     *
     * @return \Generated\Shared\Transfer\AmazonpayIpnPaymentAuthorizeRequestTransfer
     */
    public function convert(array $request)
    {
        $ipnPaymentAuthorizeRequestTransfer = new AmazonpayIpnPaymentAuthorizeRequestTransfer();

        $authDetailsTransfer = new AmazonAuthorizationDetailsTransfer();
        $authDetailsTransfer->fromArray($request['AuthorizationDetails']);

        $ipnPaymentAuthorizeRequestTransfer->setAuthorizationDetails($authDetailsTransfer);
        $ipnPaymentAuthorizeRequestTransfer->setMessageId($request['MessageId']);
        $ipnPaymentAuthorizeRequestTransfer->setNotificationReferenceId($request['NotificationReferenceId']);
        $ipnPaymentAuthorizeRequestTransfer->setReleaseEnvironment($request['ReleaseEnvironment']);
        $ipnPaymentAuthorizeRequestTransfer->setSellerId($request['SellerId']);
        $ipnPaymentAuthorizeRequestTransfer->setTopicArn($request['TopicArn']);
        $ipnPaymentAuthorizeRequestTransfer->setType($request['Type']);

        return $ipnPaymentAuthorizeRequestTransfer;
    }

}
