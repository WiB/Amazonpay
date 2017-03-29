<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AbstractAdapter;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLogger;
use Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainerInterface;

abstract class AbstractOrderTransaction extends AbstractTransaction implements OrderTransactionInterface
{

    /**
     * @var \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay
     */
    protected $paymentEntity;

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Api\Adapter\AbstractAdapter $executionAdapter
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfig $config
     * @param \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLogger $transactionLogger
     * @param \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainerInterface $amazonpayQueryContainer
     */
    public function __construct(
        AbstractAdapter $executionAdapter,
        AmazonpayConfig $config,
        TransactionLogger $transactionLogger,
        AmazonpayQueryContainerInterface $amazonpayQueryContainer
    ) {
        parent::__construct($executionAdapter, $config, $transactionLogger);

        $this->queryContainer = $amazonpayQueryContainer;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function execute(OrderTransfer $orderTransfer)
    {
        $this->apiResponse = $this->executionAdapter->call($orderTransfer);
        $orderTransfer->getAmazonpayPayment()->setResponseHeader($this->apiResponse->getHeader());
        $this->transactionsLogger->log($this->apiResponse->getHeader());
        $this->paymentEntity =
            $this->queryContainer->queryPaymentByOrderReferenceId(
                $orderTransfer->getAmazonpayPayment()->getOrderReferenceId()
            )
                ->findOne();

        return $orderTransfer;
    }

}
