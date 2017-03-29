<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger;

use Generated\Shared\Transfer\AmazonpayResponseHeaderTransfer;

interface TransactionLoggerInterface
{

    /**
     * @param \Generated\Shared\Transfer\AmazonpayResponseHeaderTransfer $headerTransfer
     *
     * @return void
     */
    public function log(AmazonpayResponseHeaderTransfer $headerTransfer);

}
