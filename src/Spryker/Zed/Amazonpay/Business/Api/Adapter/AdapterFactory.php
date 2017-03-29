<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterFactory;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface;

class AdapterFactory
{

    /**
     * @var \Spryker\Zed\Amazonpay\AmazonpayConfig
     */
    protected $config;

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterFactory
     */
    protected $converterFactory;

    /**
     * @var \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface
     */
    protected $moneyFacade;

    /**
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfig $config
     * @param \Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterFactory $converterFactory
     * @param \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface $moneyFacade
     */
    public function __construct(
        AmazonpayConfig $config,
        ConverterFactory $converterFactory,
        AmazonpayToMoneyInterface $moneyFacade
    ) {
        $this->config = $config;
        $this->converterFactory = $converterFactory;
        $this->moneyFacade = $moneyFacade;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\ObtainProfileInformationAdapter
     */
    public function createObtainProfileInformationAdapter()
    {
        return new ObtainProfileInformationAdapter(
            $this->config,
            $this->converterFactory->createObtainProfileInformationConverter(),
            $this->moneyFacade
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\SetOrderReferenceDetailsAdapter
     */
    public function createSetOrderReferenceDetailsAmazonpayAdapter()
    {
        return new SetOrderReferenceDetailsAdapter(
            $this->config,
            $this->converterFactory->createSetOrderReferenceDetailsConverter(),
            $this->moneyFacade
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\ConfirmOrderReferenceAdapter
     */
    public function createConfirmOrderReferenceAmazonpayAdapter()
    {
        return new ConfirmOrderReferenceAdapter(
            $this->config,
            $this->converterFactory->createConfirmOrderReferenceConverter(),
            $this->moneyFacade
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\GetOrderReferenceDetailsAdapter
     */
    public function createGetOrderReferenceDetailsAmazonpayAdapter()
    {
        return new GetOrderReferenceDetailsAdapter(
            $this->config,
            $this->converterFactory->createGetOrderReferenceDetailsConverter(),
            $this->moneyFacade
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\AuthorizeOrderAdapter
     */
    public function createAuthorizeOrderAdapter()
    {
        return new AuthorizeOrderAdapter(
            $this->config,
            $this->converterFactory->createAuthorizeOrderConverter(),
            $this->moneyFacade
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\CloseOrderAdapter
     */
    public function createCloseOrderAdapter()
    {
        return new CloseOrderAdapter(
            $this->config,
            $this->converterFactory->createCloseOrderConverter(),
            $this->moneyFacade
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\CancelOrderAdapter
     */
    public function createCancelOrderAdapter()
    {
        return new CancelOrderAdapter(
            $this->config,
            $this->converterFactory->createCancelOrderConverter(),
            $this->moneyFacade
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\RefundOrderAdapter
     */
    public function createRefundOrderAdapter()
    {
        return new RefundOrderAdapter(
            $this->config,
            $this->converterFactory->createRefundOrderConverter(),
            $this->moneyFacade
        );
    }

}
