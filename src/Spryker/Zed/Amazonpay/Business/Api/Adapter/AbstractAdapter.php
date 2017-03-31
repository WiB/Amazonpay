<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use PayWithAmazon\Client;
use Spryker\Zed\Amazonpay\AmazonpayConfigInterface;

abstract class AbstractAdapter
{

    const AMAZON_ORDER_REFERENCE_ID = 'amazon_order_reference_id';
    const AMAZON_ADDRESS_CONSENT_TOKEN = 'address_consent_token';
    const AMAZON_AMOUNT = 'amount';

    const MERCHANT_ID = 'merchant_id';
    const ACCESS_KEY = 'access_key';
    const SECRET_KEY = 'secret_key';
    const CLIENT_ID = 'client_id';
    const REGION = 'region';
    const CURRENCY_CODE = 'currency_code';
    const SANDBOX = 'sandbox';

    /**
     * @var \PayWithAmazon\Client
     */
    protected $client;

    /**
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfigInterface $config
     */
    public function __construct(
        AmazonpayConfigInterface $config
    ) {
        $config = [
            static::MERCHANT_ID => $config->getSellerId(),
            static::ACCESS_KEY => $config->getAccessKeyId(),
            static::SECRET_KEY => $config->getSecretAccessKey(),
            static::CLIENT_ID => $config->getClientId(),
            static::REGION => $config->getRegion(),
            static::CURRENCY_CODE => $config->getCurrencyIsoCode(),
            static::SANDBOX => true,
        ];

        $this->client = new Client($config);
    }

}
