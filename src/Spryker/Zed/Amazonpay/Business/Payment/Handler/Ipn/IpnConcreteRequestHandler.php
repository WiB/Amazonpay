<?php

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface IpnConcreteRequestHandler
{

    /**
     * @param AbstractTransfer $amazonpayIpnRequestTransfer
     *
     * @return mixed
     */
    public function handle(AbstractTransfer $amazonpayIpnRequestTransfer);
}
