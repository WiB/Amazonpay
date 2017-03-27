<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractResponseParserConverter;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface;

abstract class AbstractOrderAdapter extends AbstractAdapter implements OrderAdapterInterface
{
    /**
     * @var AbstractResponseParserConverter
     */
    protected $converter;

    /**
     * @var AmazonpayToMoneyInterface
     */
    protected $moneyFacade;

    public function __construct(
        AmazonpayConfig $config,
        AbstractResponseParserConverter $converter,
        AmazonpayToMoneyInterface $moneyFacade
    ) {
        parent::__construct($config);

        $this->converter = $converter;
        $this->moneyFacade = $moneyFacade;
    }

}
