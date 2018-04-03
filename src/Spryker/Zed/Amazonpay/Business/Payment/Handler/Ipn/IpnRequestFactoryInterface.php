<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Spryker\Shared\Transfer\AbstractTransfer;

interface IpnRequestFactoryInterface
{

    /**
     * @param \Spryker\Shared\Transfer\AbstractTransfer $ipnRequest
     *
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn\IpnRequestHandlerInterface
     */
    public function createConcreteIpnRequestHandler(AbstractTransfer $ipnRequest);

}
