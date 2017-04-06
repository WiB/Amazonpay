<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter\Sdk;

use PayWithAmazon\Client;
use PayWithAmazon\IpnHandler;
use Spryker\Zed\Amazonpay\AmazonpayConfigInterface;

interface AmazonpaySdkAdapterFactoryInterface
{

    /**
     * @param AmazonpayConfigInterface $config
     *
     * @return Client
     */
    public function createAmazonpayClient(AmazonpayConfigInterface $config);

    /**
     * @param array $headers
     * @param string $body
     *
     * @return IpnHandler
     */
    public function createAmazonpayIpnHandler(array $headers, $body);

}
