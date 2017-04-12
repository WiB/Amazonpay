<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer;
use PayWithAmazon\ResponseParser;

class AuthorizeOrderConverter extends AbstractResponseParserConverter
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
     * @return string
     */
    protected function getResponseType()
    {
        return 'AuthorizeResult';
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new AmazonpayAuthorizeOrderResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setAuthorizationDetails(
            $this->authDetailsConverter->convert($this->extractResult($responseParser)['AuthorizationDetails'])
        );

        return $responseTransfer;
    }

}
