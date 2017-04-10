<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn\Logger;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class IpnRequestLogger implements IpnRequestLoggerInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $ipnRequest
     */
    public function log(AbstractTransfer $ipnRequest)
    {
        // TODO: Implement log() method.
    }
}