<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;

use Generated\Shared\Transfer\AmazonpayAuthorizationDetailsTransfer;
use Generated\Shared\Transfer\AmazonpayIpnPaymentAuthorizeRequestTransfer;

class IpnPaymentAuthorizeRequestConverter extends IpnPaymentAbstractRequestConverter
{

    /**
     * @param array $request
     *
     * @return \Generated\Shared\Transfer\AmazonpayIpnPaymentAuthorizeRequestTransfer
     */
    public function convert(array $request)
    {
        $ipnPaymentAuthorizeRequestTransfer = new AmazonpayIpnPaymentAuthorizeRequestTransfer();
        $ipnPaymentAuthorizeRequestTransfer->setMessage($this->extractMessage($request));

        $authDetailsTransfer = new AmazonpayAuthorizationDetailsTransfer();
        $authDetailsTransfer->fromArray($request['AuthorizationDetails'], true);

        $ipnPaymentAuthorizeRequestTransfer->setAuthorizationDetails($authDetailsTransfer);

        return $ipnPaymentAuthorizeRequestTransfer;
    }

}
