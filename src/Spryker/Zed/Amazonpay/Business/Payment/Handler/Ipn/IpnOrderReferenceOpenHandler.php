<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Spryker\Shared\Amazonpay\AmazonpayConstants;

class IpnOrderReferenceOpenHandler extends IpnAbstractOrderReferenceHandler
{

    /**
     * @return string
     */
    protected function getOmsEventId()
    {
        return AmazonpayConstants::OMS_EVENT_UPDATE_SUSPENDED_ORDER;
    }

    /**
     * @return string
     */
    protected function getOmsStatusName()
    {
        return AmazonpayConstants::OMS_STATUS_PAYMENT_METHOD_CHANGED;
    }

}
