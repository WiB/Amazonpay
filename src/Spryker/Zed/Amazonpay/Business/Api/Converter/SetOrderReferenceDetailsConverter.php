<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonpaySetOrderReferenceDetailsResponseTransfer;
use PayWithAmazon\ResponseParser;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

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
     * @return AmazonpaySetOrderReferenceDetailsResponseTransfer
     */
    protected function createTransferObject()
    {
        return new AmazonpaySetOrderReferenceDetailsResponseTransfer();
    }

    protected function setBody(AbstractTransfer $responseTransfer, ResponseParser $responseParser)
    {
        $responseTransfer->setShippingAddress($this->extractShippingAddress($responseParser));

        return parent::setBody($responseTransfer, $responseParser);
    }

}
