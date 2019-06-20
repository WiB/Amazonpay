<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use AmazonPay\ResponseInterface;

interface ResponseParserConverterInterface
{

    /**
     * @param \AmazonPay\ResponseInterface $responseParser
     *
     * @return \Generated\Shared\Transfer\AbstractTransfer
     */
    public function convert(ResponseInterface $responseParser);

}
