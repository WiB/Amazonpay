<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use PayWithAmazon\Client;

abstract class AbstractAdapter
{

    const AMAZON_ORDER_REFERENCE_ID = 'amazon_order_reference_id';
    const AMAZON_ADDRESS_CONSENT_TOKEN = 'address_consent_token';
    const AMAZON_AMOUNT = 'amount';

    /**
     * @var \PayWithAmazon\Client
     */
    protected $client;

    /**
     * @param \PayWithAmazon\Client $client
     */
    public function __construct(
        Client $client
    ) {
        $this->client = $client;
    }

}
