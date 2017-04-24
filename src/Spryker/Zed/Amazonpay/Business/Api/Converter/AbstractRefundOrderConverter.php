<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonpayRefundOrderResponseTransfer;
use PayWithAmazon\ResponseParser;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

abstract class AbstractRefundOrderConverter extends AbstractResponseParserConverter
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
     * @return \Generated\Shared\Transfer\AmazonpayRefundOrderResponseTransfer
     */
    protected function createTransferObject()
    {
        return new AmazonpayRefundOrderResponseTransfer();
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected function setBody(AbstractTransfer $responseTransfer, ResponseParser $responseParser)
    {
        $responseTransfer->setRefundDetails(
            $this->refundDetailsConverter->convert($this->extractResult($responseParser)['RefundDetails'])
        );

        return parent::setBody($responseTransfer, $responseParser);
    }

}
