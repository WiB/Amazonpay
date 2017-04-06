<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\IpnRequestAdapter;

class IpnRequestHandler implements IpnHandlerInterface
{
    /**
     * @var IpnRequestAdapter
     */
    protected $ipnRequestAdapter;

    /**
     * @param IpnRequestAdapter $ipnRequestAdapter
     */
    public function __construct(
        IpnRequestAdapter $ipnRequestAdapter
    ) {
        $this->ipnRequestAdapter = $ipnRequestAdapter;
    }

    /**
     * @param array $headers
     * @param string $body
     *
     * @return AbstractTransfer
     */
    public function handle(array $headers, $body)
    {
        return $this->ipnRequestAdapter->getIpnRequest($headers, $body);
    }
}
