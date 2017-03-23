<?php
namespace Spryker\Zed\Amazonpay\Persistence;

use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \Spryker\Zed\Amazonpay\Persistence\AmazonpayPersistenceFactory getFactory()
 */
class AmazonpayQueryContainer extends AbstractQueryContainer implements AmazonpayQueryContainerInterface
{
    /**
     * @api
     *
     * @param string $orderReferenceId
     *
     * @return SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByOrderReferenceId($orderReferenceId)
    {
        return $this
            ->queryPayments()
            ->filterByOrderReferenceId($orderReferenceId);
    }
    /**
     * @api
     *
     * @return SpyPaymentAmazonpayQuery
     */
    protected function queryPayments()
    {
        return $this
            ->getFactory()
            ->createPaymentAmazonpayQuery();
    }

}
