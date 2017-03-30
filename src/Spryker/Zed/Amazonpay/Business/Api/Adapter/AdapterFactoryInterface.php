<?php
/**
 * Created by PhpStorm.
 * User: dmitrikadykov
 * Date: 29/03/2017
 * Time: 17:11
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

interface AdapterFactoryInterface
{
    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\ObtainProfileInformationAdapter
     */
    public function createObtainProfileInformationAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\SetOrderReferenceDetailsAdapter
     */
    public function createSetOrderReferenceDetailsAmazonpayAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\ConfirmOrderReferenceAdapter
     */
    public function createConfirmOrderReferenceAmazonpayAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\GetOrderReferenceDetailsAdapter
     */
    public function createGetOrderReferenceDetailsAmazonpayAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\AuthorizeOrderAdapter
     */
    public function createAuthorizeOrderAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\CloseOrderAdapter
     */
    public function createCloseOrderAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\CancelOrderAdapter
     */
    public function createCancelOrderAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\RefundOrderAdapter
     */
    public function createRefundOrderAdapter();
}
