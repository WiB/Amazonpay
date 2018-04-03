<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonpaySetOrderReferenceDetailsResponseTransfer;
use PayWithAmazon\ResponseInterface;
use Spryker\Shared\Transfer\AbstractTransfer;

class SetOrderReferenceDetailsConverter extends AbstractResponseParserConverter
{

    /**
     * @return string
     */
    protected function getResponseType()
    {
        return 'SetOrderReferenceDetailsResult';
    }

    /**
     * @return \Generated\Shared\Transfer\AmazonpaySetOrderReferenceDetailsResponseTransfer
     */
    protected function createTransferObject()
    {
        return new AmazonpaySetOrderReferenceDetailsResponseTransfer();
    }

    /**
     * @param \Spryker\Shared\Transfer\AbstractTransfer $responseTransfer
     * @param \PayWithAmazon\ResponseInterface $responseParser
     *
     * @return \Spryker\Shared\Transfer\AbstractTransfer
     */
    protected function setBody(AbstractTransfer $responseTransfer, ResponseInterface $responseParser)
    {
        $responseTransfer->setShippingAddress($this->extractShippingAddress($responseParser));

        return parent::setBody($responseTransfer, $responseParser);
    }

}
