<?php
namespace Spryker\Zed\Amazonpay\Communication;

use Spryker\Zed\Amazonpay\AmazonpayDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \Spryker\Zed\Amazonpay\AmazonpayConfig getConfig()
 * @method \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainerInterface getQueryContainer()
 */
class AmazonpayCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToSalesInterface
     */
    public function getSalesFacade()
    {
        return $this->getProvidedDependency(
            AmazonpayDependencyProvider::FACADE_SALES
        );
    }

}
