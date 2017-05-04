<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Amazonpay;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;
use Spryker\Zed\Amazonpay\Dependency\Client\AmazonpayToCalculationBridge;
use Spryker\Zed\Amazonpay\Dependency\Client\AmazonpayToCheckoutBridge;
use Spryker\Zed\Amazonpay\Dependency\Client\AmazonpayToQuoteBridge;
use Spryker\Zed\Amazonpay\Dependency\Client\AmazonpayToShipmentBridge;

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
            return new AmazonpayToQuoteBridge(
                $container->getLocator()->quote()->client()
            );
        };

        $container[self::CLIENT_SHIPMENT] = function () use ($container) {
            return new AmazonpayToShipmentBridge(
                $container->getLocator()->shipment()->client()
            );
        };

        $container[self::CLIENT_CHECKOUT] = function () use ($container) {
            return new AmazonpayToCheckoutBridge(
                $container->getLocator()->checkout()->client()
            );
        };

        $container[self::CLIENT_CALCULATION] = function () use ($container) {
            return new AmazonpayToCalculationBridge(
                $container->getLocator()->calculation()->client()
            );
        };

        return $container;
    }

}
