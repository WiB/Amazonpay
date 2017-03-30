<?php
/**
 * Created by PhpStorm.
 * User: dmitrikadykov
 * Date: 29/03/2017
 * Time: 17:38
 */

namespace Spryker\Zed\Amazonpay\Persistence;


interface AmazonpayPersistenceFactoryInterface
{
    /**
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function createPaymentAmazonpayQuery();

}
