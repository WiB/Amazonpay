<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business;

interface AmazonpayBusinessFactoryInterface
{

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\TransactionFactoryInterface
     */
    public function createTransactionFactory();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Quote\QuoteUpdateFactoryInterface
     */
    public function createQuoteUpdateFactory();

    /**
     * @return \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToRefundInterface
     */
    public function getRefundFacade();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Order\SaverInterface
     */
    public function createOrderSaver();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLoggerInterface
     */
    public function createTransactionLogger();

}
