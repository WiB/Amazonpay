<?php
namespace Spryker\Zed\Amazonpay\Persistence;

use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery;
use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface AmazonpayQueryContainerInterface extends QueryContainerInterface
{
    /**
     * @param $orderReferenceId
     *
     * @return SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByOrderReferenceId($orderReferenceId);
}
