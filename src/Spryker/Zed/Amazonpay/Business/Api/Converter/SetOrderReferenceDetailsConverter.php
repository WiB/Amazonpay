<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\SetOrderReferenceDetailsAmazonpayResponseTransfer;
use PayWithAmazon\ResponseParser;

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
     * @param ResponseParser $responseParser
     *
     * @return SetOrderReferenceDetailsAmazonpayResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new SetOrderReferenceDetailsAmazonpayResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setShippingAddress($this->extractShippingAddress($responseParser));

        return $responseTransfer;
    }
}
