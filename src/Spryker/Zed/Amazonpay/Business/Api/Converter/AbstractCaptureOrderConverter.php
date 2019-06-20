<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use AmazonPay\ResponseInterface;
use Generated\Shared\Transfer\AmazonpayCaptureOrderResponseTransfer;
use Spryker\Shared\Transfer\AbstractTransfer;

abstract class AbstractCaptureOrderConverter extends AbstractResponseParserConverter
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
     * @return /Generated\Shared\Transfer\AmazonpayCaptureOrderResponseTransfer
     */
    protected function createTransferObject()
    {
        return new AmazonpayCaptureOrderResponseTransfer();
    }

    /**
     * @param \Spryker\Shared\Transfer\AbstractTransfer $responseTransfer
     * @param \AmazonPay\ResponseInterface $responseParser
     *
     * @return \Spryker\Shared\Transfer\AbstractTransfer
     */
    protected function setBody(AbstractTransfer $responseTransfer, ResponseInterface $responseParser)
    {
        $responseTransfer->setCaptureDetails(
            $this->captureDetailsConverter->convert(
                $this->extractResult($responseParser)['CaptureDetails']
            )
        );

        return parent::setBody($responseTransfer, $responseParser);
    }

}
