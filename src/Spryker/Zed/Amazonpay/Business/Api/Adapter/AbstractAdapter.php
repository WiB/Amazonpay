<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use PayWithAmazon\Client;
use Spryker\Zed\Amazonpay\AmazonpayConfig;

abstract class AbstractAdapter
{

    /**
     * @var \PayWithAmazon\Client
     */
    protected $client;

    /**
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfig $config
     */
    public function __construct(
        AmazonpayConfig $config
    ) {
        $config = [
            'merchant_id' => $config->getSellerId(),
            'access_key' => $config->getAccessKeyId(),
            'secret_key' => $config->getSecretAccessKey(),
            'client_id' => $config->getClientId(),
            'region' => $config->getRegion(),
            'currency_code' => $config->getCurrencyIsoCode(),
            'sandbox' => true,
        ];

        $this->client = new Client($config);
    }

}
