<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use PayWithAmazon\Client;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractConverter;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface;
use Spryker\Zed\Money\Business\MoneyFacadeInterface;

abstract class AbstractAdapter
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var AbstractConverter
     */
    protected $converter;

    /**
     * @var MoneyFacadeInterface
     */
    protected $moneyFacade;

    public function __construct(
        AmazonpayConfig $config,
        AbstractConverter $converter,
        AmazonpayToMoneyInterface $moneyFacade
    ) {
        $config = [
            'merchant_id'   => $config->getSellerId(),
            'access_key'    => $config->getAccessKeyId(),
            'secret_key'    => $config->getSecretAccessKey(),
            'client_id'     => $config->getClientId(),
            'region'        => $config->getRegion(),
            'currency_code'  => $config->getCurrencyIsoCode(),
            'sandbox'       => true,
        ];

        $this->client = new Client($config);
        $this->converter = $converter;
        $this->moneyFacade = $moneyFacade;
    }

}