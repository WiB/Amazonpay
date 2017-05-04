<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Amazonpay;

interface AmazonpayConfigInterface
{

    /**
     * @return string
     */
    public function getClientId();

    /**
     * @return string
     */
    public function getAccessKeyId();

    /**
     * @return string
     */
    public function getSellerId();

    /**
     * @return string
     */
    public function getSecretAccessKey();

    /**
     * @return string
     */
    public function getClientSecret();

    /**
     * @return string
     */
    public function getRegion();

    /**
     * @return string
     */
    public function getCurrencyIsoCode();

    /**
     * @return string
     */
    public function isSandbox();

    /**
     * @return string
     */
    public function getErrorReportLevel();

    /**
     * @return bool
     */
    public function getCaptureNow();

    /**
     * @return int
     */
    public function getAuthTransactionTimeout();

}
