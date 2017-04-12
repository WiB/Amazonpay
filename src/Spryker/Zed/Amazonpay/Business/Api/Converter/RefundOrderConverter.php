<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonpayRefundOrderResponseTransfer;
use PayWithAmazon\ResponseParser;

class RefundOrderConverter extends AbstractResponseParserConverter
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
     * @return string
     */
    protected function getResponseType()
    {
        return 'RefundResult';
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AmazonpayRefundOrderResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new AmazonpayRefundOrderResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setRefundDetails(
            $this->refundDetailsConverter->convert($this->extractResult($responseParser)['RefundDetails'])
        );

        return $responseTransfer;
    }

}
