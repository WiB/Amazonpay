<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter\Sdk;

use PayWithAmazon\Client;
use PayWithAmazon\IpnHandler;
use Spryker\Zed\Amazonpay\AmazonpayConfigInterface;

class AmazonpaySdkAdapterFactory implements AmazonpaySdkAdapterFactoryInterface
{

    const MERCHANT_ID = 'merchant_id';
    const PLATFORM_ID = 'platform_id';
    const ACCESS_KEY = 'access_key';
    const SECRET_KEY = 'secret_key';
    const CLIENT_ID = 'client_id';
    const REGION = 'region';
    const CURRENCY_CODE = 'currency_code';
    const SANDBOX = 'sandbox';

    /**
     * @param AmazonpayConfigInterface $config
     *
     * @return Client
     */
    public function createAmazonpayClient(AmazonpayConfigInterface $config)
    {
        $aConfig = [
            static::MERCHANT_ID => $config->getSellerId(),
            static::PLATFORM_ID => $config->getSellerId(),
            static::ACCESS_KEY => $config->getAccessKeyId(),
            static::SECRET_KEY => $config->getSecretAccessKey(),
            static::CLIENT_ID => $config->getClientId(),
            static::REGION => $config->getRegion(),
            static::CURRENCY_CODE => $config->getCurrencyIsoCode(),
            static::SANDBOX => $config->isSandbox(),
        ];

        return new Client($aConfig);
    }

    /**
     * @param array $headers
     * @param string $body
     *
     * @return IpnHandler
     */
    public function createAmazonpayIpnHandler(array $headers, $body)
    {
        return new IpnHandler($headers, $body);
    }

}
