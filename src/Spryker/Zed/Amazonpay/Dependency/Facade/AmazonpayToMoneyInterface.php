<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Dependency\Facade;

interface AmazonpayToMoneyInterface
{

    /**
     * @param int $value
     *
     * @return float
     */
    public function convertIntegerToDecimal($value);

}
