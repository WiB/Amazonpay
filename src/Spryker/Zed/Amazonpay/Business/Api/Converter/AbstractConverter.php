<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

abstract class AbstractConverter
{

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     * @param string $name
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected function updateNameData(AbstractTransfer $transfer, $name)
    {
        $names = explode(' ', $name, 2);

        if (count($names) >= 2) {
            $transfer->setFirstName($names[0]);
            $transfer->setLastName($names[1]);
        } else {
            $transfer->setFirstName($name);
            $transfer->setLastName($name);
        }

        return $transfer;
    }

}
