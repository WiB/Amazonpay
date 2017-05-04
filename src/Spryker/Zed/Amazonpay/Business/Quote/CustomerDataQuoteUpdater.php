<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Quote;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfigInterface;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface;

class CustomerDataQuoteUpdater implements QuoteUpdaterInterface
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Adapter\ObtainProfileInformationAdapter
     */
    protected $executionAdapter;

    /**
     * @var \Spryker\Zed\Amazonpay\AmazonpayConfig
     */
    protected $config;

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface $executionAdapter
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfigInterface $config
     */
    public function __construct(
        QuoteAdapterInterface $executionAdapter,
        AmazonpayConfigInterface $config
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function update(QuoteTransfer $quoteTransfer)
    {
        $quoteTransfer->setCustomer(
            $this->executionAdapter->call($quoteTransfer)
        );

        $quoteTransfer->getCustomer()->setIsGuest(true);

        return $quoteTransfer;
    }

}
