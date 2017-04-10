<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;


interface IpnConverterFactoryInterface
{
    /**
     * @param array $request
     *
     * @return ArrayConverterInterface
     */
    public function createIpnRequestConverter(array $request);
}