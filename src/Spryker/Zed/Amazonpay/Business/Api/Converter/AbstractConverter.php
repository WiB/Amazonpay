<?php

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

abstract class AbstractConverter
{
    /**
     * @param AbstractTransfer $transfer
     * @param string $name
     *
     * @return AbstractTransfer
     */
    protected function updateNameData(AbstractTransfer $transfer, $name)
    {
        $names = explode(' ', $name, 2);

        if (sizeof($names) >= 2) {
            $transfer->setFirstName($names[0]);
            $transfer->setLastName($names[1]);
        } else {
            $transfer->setFirstName($name);
            $transfer->setLastName($name);
        }

        return $transfer;
    }
}
