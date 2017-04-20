<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

interface AdapterFactoryInterface
{

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface
     */
    public function createObtainProfileInformationAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface
     */
    public function createSetOrderReferenceDetailsAmazonpayAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface
     */
    public function createConfirmOrderReferenceAmazonpayAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface
     */
    public function createGetOrderReferenceDetailsAmazonpayAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface
     */
    public function createAuthorizeQuoteAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\OrderAdapterInterface
     */
    public function createAuthorizeOrderAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\OrderAdapterInterface
     */
    public function createCloseOrderAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\OrderAdapterInterface
     */
    public function createCancelOrderAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\OrderAdapterInterface
     */
    public function createRefundOrderAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\OrderAdapterInterface
     */
    public function createGetOrderAuthorizationDetailsAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\OrderAdapterInterface
     */
    public function createGetOrderCaptureDetailsAdapter();

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\OrderAdapterInterface
     */
    public function createGetOrderRefundDetailsAdapter();

    /**
     * @param array $headers
     * @param string $body
     *
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\IpnRequestAdapter
     */
    public function createIpnRequestAdapter(array $headers, $body);

}
