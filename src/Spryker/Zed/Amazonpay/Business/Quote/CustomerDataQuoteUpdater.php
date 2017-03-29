<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Quote;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface;

class CustomerDataQuoteUpdater implements QuoteUpdaterInterface
{

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer
     */
    protected $apiResponse;

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
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfig $config
     */
    public function __construct(
        QuoteAdapterInterface $executionAdapter,
        AmazonpayConfig $config
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
        $this->apiResponse = $this->executionAdapter->call($quoteTransfer);
        $quoteTransfer->setCustomer($this->apiResponse);

        //@todo as long as we don't have proper social login via amazon, let's do this:
        $quoteTransfer->getCustomer()->setIsGuest(true);

        return $quoteTransfer;
    }

}
