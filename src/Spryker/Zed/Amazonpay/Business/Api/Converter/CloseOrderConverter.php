<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\CloseOrderAmazonpayResponseTransfer;
use PayWithAmazon\ResponseParser;

class CloseOrderConverter extends AbstractResponseParserConverter
{
    /**
     * @return string
     */
    protected function getResponseType()
    {
        return 'CloseOrderReferenceResult';
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return CloseOrderAmazonpayResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new CloseOrderAmazonpayResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));

        return $responseTransfer;
    }
}
