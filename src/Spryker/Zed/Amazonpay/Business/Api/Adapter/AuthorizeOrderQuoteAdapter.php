<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;
use PayWithAmazon\Client;
use Spryker\Zed\Amazonpay\AmazonpayConfigInterface;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ResponseParserConverterInterface;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface;

class AuthorizeOrderQuoteAdapter extends AbstractQuoteAdapter
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
        parent::__construct($client, $converter, $moneyFacade);

        $this->captureNow = $config->getCaptureNow();
        $this->transactionTimeout = $config->getAuthTransactionTimeout();
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->authorize([
            AbstractAdapter::AMAZON_ORDER_REFERENCE_ID => $quoteTransfer->getAmazonpayPayment()->getOrderReferenceId(),
            static::AUTHORIZATION_AMOUNT => $this->getAmount($quoteTransfer),
            static::AUTHORIZATION_REFERENCE_ID => $quoteTransfer->getAmazonpayPayment()->getAuthorizationReferenceId(),
            static::TRANSACTION_TIMEOUT => $this->transactionTimeout,
            static::CAPTURE_NOW => $this->captureNow,
        ]);

        return $this->converter->convert($result);
    }

}
