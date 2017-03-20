<?php
namespace Spryker\Yves\Amazonpay;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class AmazonpayDependencyProvider extends AbstractBundleDependencyProvider
{
    const CLIENT_QUOTE = 'cart client';
    const CLIENT_SHIPMENT = 'shipment client';
    const CHECKOUT_CLIENT = 'checkout client';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container[self::CLIENT_QUOTE] = function () use ($container) {
            return $container->getLocator()->quote()->client();
        };

        $container[self::CLIENT_SHIPMENT] = function () use ($container) {
            return $container->getLocator()->shipment()->client();
        };

        $container[self::CHECKOUT_CLIENT] = function () use ($container) {
            return $container->getLocator()->checkout()->client();
        };

        return $container;
    }

}
