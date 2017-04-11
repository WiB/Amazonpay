<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\OrderTransfer;
use PayWithAmazon\Client;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ResponseParserConverterInterface;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface;

abstract class AbstractOrderAdapter extends AbstractAdapter implements OrderAdapterInterface
{

    /**
     * @param \PayWithAmazon\Client $client
     * @param \Spryker\Zed\Amazonpay\Business\Api\Converter\ResponseParserConverterInterface $converter
     * @param \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface $moneyFacade
     */
    public function __construct(
        Client $client,
        ResponseParserConverterInterface $converter,
        AmazonpayToMoneyInterface $moneyFacade
    ) {
        parent::__construct($client);

        $this->converter = $converter;
        $this->moneyFacade = $moneyFacade;
    }

}
