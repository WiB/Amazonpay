<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\SetOrderReferenceDetailsAmazonpayResponseTransfer;
use PayWithAmazon\ResponseParser;

class SetOrderReferenceDetailsConverter extends AbstractResponseParserConverter
{
    /**
     * @param ResponseParser $responseParser
     *
     * @return array
     */
    protected function extractResult(ResponseParser $responseParser)
    {
        return empty($responseParser->toArray()['SetOrderReferenceDetailsResult'])
            ? []
            : $responseParser->toArray()['SetOrderReferenceDetailsResult'];
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

        return $responseTransfer;
    }
}
