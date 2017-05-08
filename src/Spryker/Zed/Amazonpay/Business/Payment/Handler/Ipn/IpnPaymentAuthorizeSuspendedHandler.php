<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Spryker\Shared\Amazonpay\AmazonpayConstants;

class IpnPaymentAuthorizeSuspendedHandler extends IpnAbstractPaymentAuthorizeHandler
{

    /**
     * @return string
     */
    protected function getOmsStatusName()
    {
        return AmazonpayConstants::OMS_STATUS_AUTH_SUSPENDED;
    }

}
