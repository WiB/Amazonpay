<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AbstractAdapter;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\AbstractPaymentHandler;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLogger;

class AbstractTransaction extends AbstractPaymentHandler
{

    /**
     * @var \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected $apiResponse;

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLogger
     */
    protected $transactionsLogger;

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Api\Adapter\AbstractAdapter $executionAdapter
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfig $config
     * @param \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLogger $transactionLogger
     */
    public function __construct(
        AbstractAdapter $executionAdapter,
        AmazonpayConfig $config,
        TransactionLogger $transactionLogger
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->config = $config;
        $this->transactionsLogger = $transactionLogger;
    }

}
