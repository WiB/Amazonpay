<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Communication\Plugin\Oms\Condition;

use Spryker\Shared\Amazonpay\AmazonpayConstants;

class IsAuthClosedConditionPlugin extends AbstractOrderConditionPlugin
{

    /**
     * @return string
     */
    protected function getConditionalStatus()
    {
        return AmazonpayConstants::OMS_STATUS_AUTH_CLOSED;
    }

}
