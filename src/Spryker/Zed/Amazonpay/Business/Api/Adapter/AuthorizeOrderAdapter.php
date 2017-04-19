<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use PayWithAmazon\Client;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfigInterface;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ResponseParserConverterInterface;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface;

class AuthorizeOrderAdapter extends AbstractAdapter implements AbstractAdapterInterface
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

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $quoteOrderTransfer
     *
     * @return \Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer
     */
    public function call(AbstractTransfer $quoteOrderTransfer)
    {
        $result = $this->client->authorize([
            static::AMAZON_ORDER_REFERENCE_ID => $quoteOrderTransfer->getAmazonpayPayment()->getOrderReferenceId(),
            static::AUTHORIZATION_AMOUNT => $this->getAmount($quoteOrderTransfer),
            static::AUTHORIZATION_REFERENCE_ID => $quoteOrderTransfer->getAmazonpayPayment()->getAuthorizationReferenceId(),
            static::TRANSACTION_TIMEOUT => $this->transactionTimeout,
            static::CAPTURE_NOW => $this->captureNow,
            'seller_authorization_note' => '{"SandboxSimulation": {"State":"Declined", "ReasonCode":"InvalidPaymentMethod", "PaymentMethodUpdateTimeInMins":1, "SoftDecline":"false"}}'
        ]);

        return $this->converter->convert($result);
    }

}
