<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;


use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterFactory;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface;

class AdapterFactory
{
    /**
     * @var AmazonpayConfig
     */
    protected $config;

    /**
     * @var ConverterFactory
     */
    protected $converterFactory;

    /**
     * @var AmazonpayToMoneyInterface
     */
    protected $moneyFacade;

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
     * @return ObtainProfileInformationAdapter
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
     * @return SetOrderReferenceDetailsAdapter
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
     * @return ConfirmOrderReferenceAdapter
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
     * @return GetOrderReferenceDetailsAdapter
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
     * @return AuthorizeOrderAdapter
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
     * @return CloseOrderAdapter
     */
    public function createCloseOrderAdapter()
    {
        return new CloseOrderAdapter(
            $this->config,
            $this->converterFactory->createCloseOrderConverter()
        );
    }

    /**
     * @return CancelOrderAdapter
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
     * @return RefundOrderAdapter
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