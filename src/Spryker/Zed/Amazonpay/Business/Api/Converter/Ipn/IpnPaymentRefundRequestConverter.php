<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;

use Generated\Shared\Transfer\AmazonpayIpnPaymentRefundRequestTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface;

class IpnPaymentRefundRequestConverter extends IpnPaymentAbstractRequestConverter
{

    /**
     * @var ArrayConverterInterface $refundDetailsConverter
     */
    protected $refundDetailsConverter;

    /**
     * @param ArrayConverterInterface $refundDetailsConverter
     */
    public function __construct(ArrayConverterInterface $refundDetailsConverter)
    {
        $this->refundDetailsConverter = $refundDetailsConverter;
    }

    /**
     * @param array $request
     *
     * @return \Generated\Shared\Transfer\AmazonpayIpnPaymentRefundRequestTransfer
     */
    public function convert(array $request)
    {
        $ipnPaymentRefundRequestTransfer = new AmazonpayIpnPaymentRefundRequestTransfer();
        $ipnPaymentRefundRequestTransfer->setMessage($this->extractMessage($request));

        $ipnPaymentRefundRequestTransfer->setRefundDetails(
            $this->refundDetailsConverter->convert($request['RefundDetails'])
        );

        return $ipnPaymentRefundRequestTransfer;
    }

}