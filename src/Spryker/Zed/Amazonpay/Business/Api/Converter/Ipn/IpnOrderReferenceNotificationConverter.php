<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;

use Generated\Shared\Transfer\AmazonpayIpnOrderReferenceNotificationTransfer;
use Generated\Shared\Transfer\AmazonpayOrderReferenceNotificationTransfer;

class IpnOrderReferenceNotificationConverter extends IpnPaymentAbstractRequestConverter
{

    /**
     * @param array $request
     *
     * @return \Generated\Shared\Transfer\AmazonpayIpnPaymentAuthorizeRequestTransfer
     */
    public function convert(array $request)
    {
        $ipnOrderReferenceNotificationTransfer = new AmazonpayIpnOrderReferenceNotificationTransfer();
        $ipnOrderReferenceNotificationTransfer->setMessage($this->extractMessage($request));

        $orderRefrenceNotification = new AmazonpayOrderReferenceNotificationTransfer();
//        $orderRefrenceNotification->setAmazonOrderReferenceId();

        $orderRefrenceNotification = new AmazonpayIpnOrderReferenceNotificationTransfer();
//        $ipnOrderReferenceNotificationTransfer->setOrderReferenceNotification();

//        $ipnPaymentAuthorizeRequestTransfer->setAuthorizationDetails(
//            $this->authDetailsConverter->convert($request['AuthorizationDetails'])
//        );

        return $ipnOrderReferenceNotificationTransfer;
    }

}