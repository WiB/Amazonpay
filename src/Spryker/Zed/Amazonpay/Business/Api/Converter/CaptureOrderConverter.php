<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

class CaptureOrderConverter extends AbstractCaptureOrderConverter
{

    /**
     * @return string
     */
    protected function getResponseType()
    {
        return 'CaptureResult';
    }

}
