<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\Amazonpay;

use Spryker\Client\Amazonpay\Zed\AmazonpayStub;
use Spryker\Client\Kernel\AbstractFactory;

class AmazonpayFactory extends AbstractFactory
{

    /**
     * @return \Spryker\Client\Amazonpay\Zed\AmazonpayStubInterface
     */
    public function createZedStub()
    {
        return new AmazonpayStub($this->getProvidedDependency(AmazonpayDependencyProvider::SERVICE_ZED));
    }

}
