<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Spryker\Shared\Amazonpay\AmazonpayConstants;

class IpnPaymentCaptureCompletedHandler extends IpnAbstractPaymentCaptureHandler
{

    /**
     * @return string
     */
    protected function getOmsStatusName()
    {
        return AmazonpayConstants::OMS_STATUS_CAPTURE_COMPLETED;
    }

}
