<?php

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface IpnRequestHandlerInterface
{

    /**
     * @param AbstractTransfer $amazonpayIpnRequestTransfer
     */
    public function handle(AbstractTransfer $amazonpayIpnRequestTransfer);
}
