<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractResponseParserConverter;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface;

abstract class AbstractQuoteAdapter extends AbstractAdapter implements QuoteAdapterInterface
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractResponseParserConverter
     */
    protected $converter;

    /**
     * @var \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface
     */
    protected $moneyFacade;

    /**
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfig $config
     * @param \Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractResponseParserConverter $converter
     * @param \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface $moneyFacade
     */
    public function __construct(
        AmazonpayConfig $config,
        AbstractResponseParserConverter $converter,
        AmazonpayToMoneyInterface $moneyFacade
    ) {
        parent::__construct($config);

        $this->converter = $converter;
        $this->moneyFacade = $moneyFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return float
     */
    protected function getAmount(QuoteTransfer $quoteTransfer)
    {
        return $this->moneyFacade->convertIntegerToDecimal(
            $quoteTransfer->requireTotals()->getTotals()->getGrandTotal()
        );
    }

}
