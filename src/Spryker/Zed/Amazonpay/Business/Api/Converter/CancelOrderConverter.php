<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonpayCancelOrderResponseTransfer;

class CancelOrderConverter extends AbstractResponseParserConverter
{

    /**
     * @return string
     */
    protected function getResponseType()
    {
        return 'CancelOrderReferenceResult';
    }

    /**
     * @return \Generated\Shared\Transfer\AmazonpayCancelOrderResponseTransfer
     */
    protected function createTransferObject()
    {
        return new AmazonpayCancelOrderResponseTransfer();
    }

}
