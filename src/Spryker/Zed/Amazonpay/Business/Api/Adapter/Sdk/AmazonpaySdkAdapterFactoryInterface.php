<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter\Sdk;

use Spryker\Shared\Amazonpay\AmazonpayConfigInterface;

interface AmazonpaySdkAdapterFactoryInterface
{

    /**
     * @param \Spryker\Shared\Amazonpay\AmazonpayConfigInterface $config
     *
     * @return \PayWithAmazon\Client
     */
    public function createAmazonpayClient(AmazonpayConfigInterface $config);

    /**
     * @param array $headers
     * @param string $body
     *
     * @return \PayWithAmazon\IpnHandler
     */
    public function createAmazonpayIpnHandler(array $headers, $body);

}
