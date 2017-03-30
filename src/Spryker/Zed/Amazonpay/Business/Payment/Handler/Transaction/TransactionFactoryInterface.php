<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;


interface TransactionFactoryInterface
{
    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\ConfirmOrderReferenceTransaction
     */
    public function createConfirmOrderReferenceTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\SetOrderReferenceDetailsTransaction
     */
    public function createSetOrderReferenceTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\GetOrderReferenceDetailsTransaction
     */
    public function createGetOrderReferenceDetailsTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\CancelOrderTransaction
     */
    public function createCancelOrderTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\AuthorizeOrderTransaction
     */
    public function createAuthorizeOrderTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\CloseOrderTransaction
     */
    public function createCloseOrderTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\RefundOrderTransaction
     */
    public function createRefundOrderTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\HandleDeclinedOrderTransaction
     */
    public function createHandleDeclinedOrderTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\ConfirmPurchaseTransactionCollection
     */
    public function createConfirmPurchaseTransactionCollection();
}

