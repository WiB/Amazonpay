<?php
/**
 * Created by PhpStorm.
 * User: dmitrikadykov
 * Date: 29/03/2017
 * Time: 17:09
 */

namespace Spryker\Zed\Amazonpay\Business;


interface AmazonpayBusinessFactoryInterface
{
    public function getTransactionFactory();

    public function getQuoteUpdateFactory();

    public function getRefundFacade();

    public function createOrderSaver();
}