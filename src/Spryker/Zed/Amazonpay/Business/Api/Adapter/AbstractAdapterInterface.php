<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Spryker\Shared\Transfer\AbstractTransfer;

interface AbstractAdapterInterface
{

    /**
     * @param \Spryker\Shared\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return \Spryker\Shared\Transfer\AbstractTransfer
     */
    public function call(AbstractTransfer $abstractTransfer);

}
