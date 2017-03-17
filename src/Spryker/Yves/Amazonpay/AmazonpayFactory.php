<?php
namespace Spryker\Yves\Amazonpay;

use Spryker\Shared\Amazonpay\AmazonpayConfig;
use Spryker\Yves\Kernel\AbstractFactory;

class AmazonpayFactory extends AbstractFactory
{
    /**
     * @return QuoteClient
     */
    public function getQuoteClient()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_QUOTE);
    }

    /**
     * @return AmazonpayConfig
     */
    public function getConfig()
    {
        return new AmazonpayConfig();
    }

}
