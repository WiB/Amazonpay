<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;

use Generated\Shared\Transfer\AmazonpayIpnPaymentCaptureRequestTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface;

class IpnPaymentCaptureRequestConverter extends IpnPaymentAbstractRequestConverter
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface $captureDetailsConverter
     */
    protected $captureDetailsConverter;

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface $captureDetailsConverter
     */
    public function __construct(ArrayConverterInterface $captureDetailsConverter)
    {
        $this->captureDetailsConverter = $captureDetailsConverter;
    }

    /**
     * @param array $request
     *
     * @return \Generated\Shared\Transfer\AmazonpayIpnPaymentCaptureRequestTransfer
     */
    public function convert(array $request)
    {
        $ipnPaymentCaptureRequestTransfer = new AmazonpayIpnPaymentCaptureRequestTransfer();
        $ipnPaymentCaptureRequestTransfer->setMessage($this->extractMessage($request));

        $ipnPaymentCaptureRequestTransfer->setCaptureDetails(
            $this->captureDetailsConverter->convert($request['CaptureDetails'])
        );

        return $ipnPaymentCaptureRequestTransfer;
    }

}
