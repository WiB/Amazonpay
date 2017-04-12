<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;

use Generated\Shared\Transfer\AmazonpayAuthorizationDetailsTransfer;
use Generated\Shared\Transfer\AmazonpayIpnPaymentAuthorizeRequestTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface;

class IpnPaymentAuthorizeRequestConverter extends IpnPaymentAbstractRequestConverter
{

    /**
     * @var ArrayConverterInterface $authDetailsConverter
     */
    protected $authDetailsConverter;

    /**
     * @param ArrayConverterInterface $authDetailsConverter
     */
    public function __construct(ArrayConverterInterface $authDetailsConverter)
    {
        $this->authDetailsConverter = $authDetailsConverter;
    }

    /**
     * @param array $request
     *
     * @return \Generated\Shared\Transfer\AmazonpayIpnPaymentAuthorizeRequestTransfer
     */
    public function convert(array $request)
    {
        $ipnPaymentAuthorizeRequestTransfer = new AmazonpayIpnPaymentAuthorizeRequestTransfer();
        $ipnPaymentAuthorizeRequestTransfer->setMessage($this->extractMessage($request));

//        $authDetailsTransfer = new AmazonpayAuthorizationDetailsTransfer();
//        $authDetailsTransfer->fromArray($request['AuthorizationDetails'], true);

        $ipnPaymentAuthorizeRequestTransfer->setAuthorizationDetails(
            $this->authDetailsConverter->convert($request['AuthorizationDetails'])
        );

        return $ipnPaymentAuthorizeRequestTransfer;
    }

}
