<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer;
use PayWithAmazon\ResponseParser;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

abstract class AbstractAuthorizeOrderConverter extends AbstractResponseParserConverter
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface $authDetailsConverter
     */
    protected $authDetailsConverter;

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface $authDetailsConverter
     */
    public function __construct(ArrayConverterInterface $authDetailsConverter)
    {
        $this->authDetailsConverter = $authDetailsConverter;
    }

    /**
     * @return \Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer
     */
    protected function createTransferObject()
    {
        return new AmazonpayAuthorizeOrderResponseTransfer();
    }

    /**
     * @param \Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer|AbstractTransfer $responseTransfer
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer
     */
    protected function setBody(AbstractTransfer $responseTransfer, ResponseParser $responseParser)
    {
        $responseTransfer->setAuthorizationDetails(
            $this->authDetailsConverter->convert($this->extractResult($responseParser)['AuthorizationDetails'])
        );

        return parent::setBody($responseTransfer, $responseParser);
    }

}
