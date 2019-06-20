<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter\Sdk;

use Spryker\Shared\Amazonpay\AmazonpayConfigInterface;

interface AmazonpaySdkAdapterFactoryInterface
{

    /**
     * @param \Spryker\Shared\Amazonpay\AmazonpayConfigInterface $config
     *
     * @return \AmazonPay\Client
     */
    public function createAmazonpayClient(AmazonpayConfigInterface $config);

    /**
     * @param array $headers
     * @param string $body
     *
     * @return \AmazonPay\IpnHandler
     */
    public function createAmazonpayIpnHandler(array $headers, $body);

}
