<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\AmazonpayGetOrderReferenceDetailsResponseTransfer;
use PayWithAmazon\ResponseParser;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class GetOrderReferenceDetailsConverter extends AbstractResponseParserConverter
{

    /**
     * @return string
     */
    protected function getResponseType()
    {
        return 'GetOrderReferenceDetailsResult';
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return array
     */
    protected function extractOrderReferenceStatus(ResponseParser $responseParser)
    {
        return $this->extractResult($responseParser)['OrderReferenceDetails']['OrderReferenceStatus']['State'];
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    protected function extractBillingAddress(ResponseParser $responseParser)
    {
        $address = new AddressTransfer();

        if (!$this->isSuccess($responseParser)) {
            return $address;
        }

        $aResponseAddress =
            $this->extractResult($responseParser)['OrderReferenceDetails']['BillingAddress']['PhysicalAddress'];

        return $this->convertAddressToTransfer($aResponseAddress);
    }

    /**
     * @return \Generated\Shared\Transfer\AmazonpayGetOrderReferenceDetailsResponseTransfer
     */
    protected function createTransferObject()
    {
        return new AmazonpayGetOrderReferenceDetailsResponseTransfer();
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected function setBody(
        AbstractTransfer $responseTransfer,
        ResponseParser $responseParser
    ) {
        $responseTransfer->setOrderReferenceStatus($this->extractOrderReferenceStatus($responseParser));
        $responseTransfer->setShippingAddress($this->extractShippingAddress($responseParser));
        $responseTransfer->setBillingAddress($this->extractBillingAddress($responseParser));

        return parent::setBody($responseTransfer, $responseParser);
    }

}
