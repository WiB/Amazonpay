<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\CustomerTransfer;

interface ArrayConverterInterface
{
    /**
     * @param array $response
     *
     * @return CustomerTransfer
     */
    public function convert(array $response);
}
