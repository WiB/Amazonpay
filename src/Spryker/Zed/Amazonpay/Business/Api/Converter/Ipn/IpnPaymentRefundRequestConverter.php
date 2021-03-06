<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;

use Generated\Shared\Transfer\AmazonpayIpnPaymentRefundRequestTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface;

class IpnPaymentRefundRequestConverter extends IpnPaymentAbstractRequestConverter
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface $refundDetailsConverter
     */
    protected $refundDetailsConverter;

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface $refundDetailsConverter
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
