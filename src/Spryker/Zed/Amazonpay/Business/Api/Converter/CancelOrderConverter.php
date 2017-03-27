<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\CancelOrderAmazonpayResponseTransfer;
use PayWithAmazon\ResponseParser;

class CancelOrderConverter extends AbstractResponseParserConverter
{
    /**
     * @return string
     */
    protected function getResponseType()
    {
        return 'CancelOrderReferenceResult';
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return CancelOrderAmazonpayResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new CancelOrderAmazonpayResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));

        return $responseTransfer;
    }
}
