<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\GetOrderReferenceDetailsAmazonpayResponseTransfer;
use PayWithAmazon\ResponseParser;

class GetOrderReferenceDetailsConverter extends AbstractConverter
{
    /**
     * @param ResponseParser $responseParser
     *
     * @return array
     */
    protected function extractAddressArray(ResponseParser $responseParser)
    {
        return $responseParser->toArray()['GetOrderReferenceDetailsResult']['OrderReferenceDetails']['Destination']['PhysicalDestination'];
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return GetOrderReferenceDetailsAmazonpayResponseTransfer
     */
    public function toTransactionResponseTransfer(ResponseParser $responseParser)
    {
        $responseTransfer = new GetOrderReferenceDetailsAmazonpayResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setAddress($this->extractAddress($responseParser));

        return $responseTransfer;
    }
}
