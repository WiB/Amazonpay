<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\SetOrderReferenceDetailsAmazonpayResponseTransfer;
use PayWithAmazon\ResponseParser;

class SetOrderReferenceDetailsConverter extends AbstractConverter
{
    /**
     * @param ResponseParser $responseParser
     *
     * @return array
     */
    protected function extractAddressArray(ResponseParser $responseParser)
    {
        return $responseParser->toArray()['SetOrderReferenceDetailsResult']['OrderReferenceDetails']['Destination']['PhysicalDestination'];
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return SetOrderReferenceDetailsAmazonpayResponseTransfer
     */
    public function toTransactionResponseTransfer(ResponseParser $responseParser)
    {
        $responseTransfer = new SetOrderReferenceDetailsAmazonpayResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setAddress($this->extractAddress($responseParser));

        return $responseTransfer;
    }
}
