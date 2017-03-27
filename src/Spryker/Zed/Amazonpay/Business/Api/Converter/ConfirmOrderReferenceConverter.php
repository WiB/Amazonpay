<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\ConfirmOrderReferenceAmazonpayResponseTransfer;
use PayWithAmazon\ResponseParser;

class ConfirmOrderReferenceConverter extends AbstractResponseParserConverter
{
    /**
     * @return string
     */
    protected function getResponseType()
    {
        return 'ConfirmOrderReferenceResult';
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return ConfirmOrderReferenceAmazonpayResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new ConfirmOrderReferenceAmazonpayResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));

        return $responseTransfer;
    }
}
