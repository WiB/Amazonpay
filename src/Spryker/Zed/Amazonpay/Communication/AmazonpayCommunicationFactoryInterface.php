<?php
/**
 * Created by PhpStorm.
 * User: dmitrikadykov
 * Date: 30/03/2017
 * Time: 13:40
 */

namespace Spryker\Zed\Amazonpay\Communication;

interface AmazonpayCommunicationFactoryInterface
{
    /**
     * @return \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToSalesInterface
     */
    public function getSalesFacade();
}
