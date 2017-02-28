<?php
namespace Spryker\Zed\Amazonpay\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Amazonpay\PayoneDependencyProvider;

/**
 * @method \Spryker\Zed\Amazonpay\AmazonpayConfig getConfig()
 * @method \Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainerInterface getQueryContainer()
 */
class AmazonpayCommunicationFactory extends AbstractCommunicationFactory
{

    /**
     * @return \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToOmsInterface
     */
    public function getOmsFacade()
    {
        return $this->getProvidedDependency(PayoneDependencyProvider::FACADE_OMS);
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToRefundInterface
     */
    public function getRefundFacade()
    {
        return $this->getProvidedDependency(PayoneDependencyProvider::FACADE_REFUND);
    }

}
