<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Amazonpay;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class AmazonpayDependencyProvider extends AbstractBundleDependencyProvider
{

    const CLIENT_CART = 'cart client';
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
        $container[self::CLIENT_CART] = function () use ($container) {
            return $container->getLocator()->cart()->client();
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

        return $container;
    }

}
