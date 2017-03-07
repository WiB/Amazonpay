<?php
namespace Spryker\Yves\Amazonpay;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class AmazonpayDependencyProvider extends AbstractBundleDependencyProvider
{
    const CLIENT_QUOTE = 'cart client';

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

        return $container;
    }

}
