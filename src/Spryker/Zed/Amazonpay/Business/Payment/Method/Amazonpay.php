<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Method;

use Spryker\Shared\Amazonpay\AmazonpayConstants;

class Amazonpay
{

    /**
     * @return string
     */
    public function getMethodName()
    {
        return AmazonpayConstants::PAYMENT_METHOD;
    }

}
