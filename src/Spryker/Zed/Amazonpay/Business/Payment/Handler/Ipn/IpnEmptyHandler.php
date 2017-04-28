<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class IpnEmptyHandler implements IpnRequestHandlerInterface
{

    /**
     * @param AbstractTransfer $amazonpayIpnRequestTransfer
     */
    public function handle(AbstractTransfer $amazonpayIpnRequestTransfer)
    {
        // do nothing. but probably logging has to be added. and for others transactions as well
    }

}