<?php
namespace Spryker\Zed\Amazonpay\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Amazonpay\Business\Model\QuoteDataUpdater;

/**
 * @method \Spryker\Zed\Amazonpay\AmazonpayConfig getConfig()
 * @method \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainer getQueryContainer()
 */
class AmazonpayBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return QuoteDataUpdater
     */
    public function createQuoteDataUpdater()
    {
        return new QuoteDataUpdater();
    }

}
