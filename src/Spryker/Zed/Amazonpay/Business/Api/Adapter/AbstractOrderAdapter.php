<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractResponseParserConverter;

abstract class AbstractOrderAdapter extends AbstractAdapter implements OrderAdapterInterface
{
    /**
     * @var AbstractResponseParserConverter
     */
    protected $converter;

    public function __construct(
        AmazonpayConfig $config,
        AbstractResponseParserConverter $converter
    ) {
        parent::__construct($config);

        $this->converter = $converter;
    }

}
