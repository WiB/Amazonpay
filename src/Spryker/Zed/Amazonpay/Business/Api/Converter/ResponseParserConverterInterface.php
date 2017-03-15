<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use PayWithAmazon\ResponseParser;

interface ResponseParserConverterInterface
{
    public function convert(ResponseParser $responseParser);
}
