<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Generated\Shared\Transfer\AmazonpayIpnPaymentAuthorizeRequestTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class IpnPaymentAuthorizeHandler implements IpnConcreteRequestHandler
{

    public function __construct()
    {
    }

    /**
     * @param AbstractTransfer $amazonpayIpnRequestTransfer
     *
     * @return mixed
     */
    public function handle(AbstractTransfer $amazonpayIpnRequestTransfer)
    {
        // AbstractTransfer::class
        // do all stuff here
    }
}
