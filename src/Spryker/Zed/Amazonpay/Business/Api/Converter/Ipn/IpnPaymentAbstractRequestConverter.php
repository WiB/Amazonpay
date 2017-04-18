<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;

use Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractArrayConverter;
use Generated\Shared\Transfer\AmazonpayIpnRequestMessageTransfer;

abstract class IpnPaymentAbstractRequestConverter extends AbstractArrayConverter
{
    /**
     * @param array $request
     *
     * @return AmazonpayIpnRequestMessageTransfer
     */
    protected function extractMessage(array $request)
    {
        $ipnRequestMessageTransfer = new AmazonpayIpnRequestMessageTransfer();
        $ipnRequestMessageTransfer->setMessageId($request['MessageId']);
        $ipnRequestMessageTransfer->setNotificationReferenceId($request['NotificationReferenceId']);
        $ipnRequestMessageTransfer->setNotificationType($request['NotificationType']);
        $ipnRequestMessageTransfer->setReleaseEnvironment($request['ReleaseEnvironment']);
        $ipnRequestMessageTransfer->setSellerId($request['SellerId']);
        $ipnRequestMessageTransfer->setTopicArn($request['TopicArn']);
        $ipnRequestMessageTransfer->setType($request['Type']);

        return $ipnRequestMessageTransfer;

    }

}