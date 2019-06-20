<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use AmazonPay\ResponseInterface;
use Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer;
use Spryker\Shared\Transfer\AbstractTransfer;

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
     * @param \AmazonPay\ResponseInterface $responseParser
     *
     * @return \Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer
     */
    protected function setBody(AbstractTransfer $responseTransfer, ResponseInterface $responseParser)
    {
        $responseTransfer->setAuthorizationDetails(
            $this->authDetailsConverter->convert($this->extractResult($responseParser)['AuthorizationDetails'])
        );

        return parent::setBody($responseTransfer, $responseParser);
    }

}
