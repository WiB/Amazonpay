<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\ConfirmOrderReferenceAmazonpayResponseTransfer;
use PayWithAmazon\ResponseParser;

class ConfirmOrderReferenceConverter extends AbstractConverter
{
    /**
     * @param ResponseParser $responseParser
     *
     * @return ConfirmOrderReferenceAmazonpayResponseTransfer
     */
    public function toTransactionResponseTransfer(ResponseParser $responseParser)
    {
        $responseTransfer = new ConfirmOrderReferenceAmazonpayResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));

        return $responseTransfer;
    }
}
