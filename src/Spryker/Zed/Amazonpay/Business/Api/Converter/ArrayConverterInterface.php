<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

interface ArrayConverterInterface
{

    /**
     * @param array $data
     *
     * @return \Spryker\Shared\Transfer\AbstractTransfer
     */
    public function convert(array $data);

}
