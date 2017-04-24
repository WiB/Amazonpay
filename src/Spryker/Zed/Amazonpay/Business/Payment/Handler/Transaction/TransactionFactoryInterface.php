<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

interface TransactionFactoryInterface
{

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\QuoteTransactionInterface
     */
    public function createConfirmOrderReferenceTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\QuoteTransactionInterface
     */
    public function createSetOrderReferenceTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\QuoteTransactionInterface
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
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\ReauthorizeOrderTransaction
     */
    public function createReauthorizeOrderTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionCollection
     */
    public function createCaptureAuthorizedTransactionCollection();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface
     */
    public function createCloseOrderTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface
     */
    public function createRefundOrderTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\HandleDeclinedOrderTransaction
     */
    public function createHandleDeclinedOrderTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\QuoteTransactionCollection
     */
    public function createConfirmPurchaseTransactionCollection();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface
     */
    public function createUpdateOrderRefundStatusTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface
     */
    public function createUpdateOrderAuthorizationStatusTransaction();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface
     */
    public function createUpdateOrderCaptureStatusTransaction();

}
