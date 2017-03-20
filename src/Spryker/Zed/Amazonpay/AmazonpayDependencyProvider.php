<?php
namespace Spryker\Zed\Amazonpay;

use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyBridge;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToShipmentBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AmazonpayDependencyProvider extends AbstractBundleDependencyProvider
{
    const FACADE_MONEY = 'money facade';
    const FACADE_SHIPMENT = 'shipment facade';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addMoneyFacade($container);
        $container = $this->addShipmentFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMoneyFacade(Container $container)
    {
        $container[self::FACADE_MONEY] = function (Container $container) {
            return new AmazonpayToMoneyBridge($container->getLocator()->money()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addShipmentFacade(Container $container)
    {
        $container[self::FACADE_SHIPMENT] = function (Container $container) {
            return new AmazonpayToShipmentBridge($container->getLocator()->shipment()->facade());
        };

        return $container;
    }

}
