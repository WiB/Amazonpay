<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonpayCaptureOrderResponseTransfer;
use PayWithAmazon\ResponseParser;

class CaptureOrderConverter extends AbstractResponseParserConverter
{

    /**
     * @var ArrayConverterInterface $captureDetailsConverter
     */
    protected $captureDetailsConverter;

    /**
     * @param ArrayConverterInterface $captureDetailsConverter
     */
    public function __construct(ArrayConverterInterface $captureDetailsConverter)
    {
        $this->captureDetailsConverter = $captureDetailsConverter;
    }

    /**
     * @return string
     */
    protected function getResponseType()
    {
        return 'CaptureResult';
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AmazonpayCaptureOrderResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new AmazonpayCaptureOrderResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setCaptureDetails(
            $this->captureDetailsConverter->convert(
                $this->extractResult($responseParser)['CaptureDetails']
            )
        );

        return $responseTransfer;
    }

}
