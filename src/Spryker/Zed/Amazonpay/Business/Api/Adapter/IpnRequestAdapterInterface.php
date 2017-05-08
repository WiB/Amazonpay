<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

interface IpnRequestAdapterInterface
{

    /**
     * @return array
     */
    public function getIpnRequest();

}
