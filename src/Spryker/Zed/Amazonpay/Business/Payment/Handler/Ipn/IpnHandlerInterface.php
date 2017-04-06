<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface IpnHandlerInterface
{
    /**
     * @param array $headers
     * @param string $body
     *
     * @return AbstractTransfer
     */
    public function handle(array $headers, $body);

}
