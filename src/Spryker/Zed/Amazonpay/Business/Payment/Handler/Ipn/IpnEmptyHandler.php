<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Spryker\Shared\Transfer\AbstractTransfer;

class IpnEmptyHandler implements IpnRequestHandlerInterface
{

    /**
     * @param \Spryker\Shared\Transfer\AbstractTransfer $amazonpayIpnRequestTransfer
     *
     * @return void
     */
    public function handle(AbstractTransfer $amazonpayIpnRequestTransfer)
    {
        // do nothing. but probably logging has to be added. and for others transactions as well
    }

}
