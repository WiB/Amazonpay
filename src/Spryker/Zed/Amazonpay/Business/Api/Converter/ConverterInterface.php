<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use PayWithAmazon\ResponseParser;

interface ConverterInterface
{
    public function toTransactionResponseTransfer(ResponseParser $responseParser);

}
