<?php
namespace Spryker\Zed\Amazonpay\Persistence;

use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Spryker\Zed\Amazonpay\AmazonpayConfig getConfig()
 * @method \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainer getQueryContainer()
 */
class AmazonpayPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function createPaymentAmazonpayQuery()
    {
        return SpyPaymentAmazonpayQuery::create();
    }

}
