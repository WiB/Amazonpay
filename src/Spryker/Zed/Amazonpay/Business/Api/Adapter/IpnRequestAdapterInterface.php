<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;


interface IpnRequestAdapterInterface
{
    /**
     * @param array $headers
     * @param string $body
     *
     * @return array
     */
    public function getIpnRequest($headers, $body);

}