<?php
namespace Spryker\Yves\Amazonpay;

use Pyz\Yves\Checkout\Plugin\CheckoutBreadcrumbPlugin;
use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class AmazonpayDependencyProvider extends AbstractBundleDependencyProvider
{
    const CLIENT_QUOTE = 'cart client';
    const CLIENT_SHIPMENT = 'shipment client';
    const CLIENT_CHECKOUT = 'checkout client';
    const CLIENT_CALCULATION = 'calculation client';
    const PLUGIN_CHECKOUT_BREADCRUMB = 'plugin checkout breadcrumb';

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

        $container[self::CLIENT_CHECKOUT] = function () use ($container) {
            return $container->getLocator()->checkout()->client();
        };

        $container[self::CLIENT_CALCULATION] = function () use ($container) {
            return $container->getLocator()->calculation()->client();
        };

        $container[self::PLUGIN_CHECKOUT_BREADCRUMB] = function () use ($container) {
            return new CheckoutBreadcrumbPlugin();
        };

        return $container;
    }

}
