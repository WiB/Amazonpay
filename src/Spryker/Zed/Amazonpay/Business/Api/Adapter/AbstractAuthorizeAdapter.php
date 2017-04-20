<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\AmazonpayPaymentTransfer;
use PayWithAmazon\Client;
use Spryker\Zed\Amazonpay\AmazonpayConfigInterface;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ResponseParserConverterInterface;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface;


abstract class AbstractAuthorizeAdapter extends AbstractAdapter
{

    const AUTHORIZATION_AMOUNT = 'authorization_amount';
    const AUTHORIZATION_REFERENCE_ID = 'authorization_reference_id';
    const TRANSACTION_TIMEOUT = 'transaction_timeout';
    const CAPTURE_NOW = 'capture_now';

    /**
     * @var bool
     */
    protected $captureNow;

    /**
     * @var int
     */
    protected $transactionTimeout;

    public function __construct(
        Client $client,
        ResponseParserConverterInterface $converter,
        AmazonpayToMoneyInterface $moneyFacade,
        AmazonpayConfigInterface $config
    ) {
        parent::__construct($client);

        $this->converter = $converter;
        $this->moneyFacade = $moneyFacade;
        $this->captureNow = $config->getCaptureNow();
        $this->transactionTimeout = $config->getAuthTransactionTimeout();
    }

    protected function buildRequestArray(AmazonpayPaymentTransfer $amazonpayPaymentTransfer, $amount)
    {
        return [
            static::AMAZON_ORDER_REFERENCE_ID => $amazonpayPaymentTransfer->getOrderReferenceId(),
            static::AUTHORIZATION_AMOUNT => $amount,
            static::AUTHORIZATION_REFERENCE_ID => $amazonpayPaymentTransfer->getAuthorizationReferenceId(),
            static::TRANSACTION_TIMEOUT => $this->transactionTimeout,
            static::CAPTURE_NOW => $this->captureNow,
            // 'seller_authorization_note' => '{"SandboxSimulation": {"State":"Declined", "ReasonCode":"InvalidPaymentMethod", "PaymentMethodUpdateTimeInMins":1, "SoftDecline":"false"}}'
        ];
    }
}