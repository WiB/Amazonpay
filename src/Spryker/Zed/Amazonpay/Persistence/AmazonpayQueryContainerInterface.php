<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Persistence;

use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface AmazonpayQueryContainerInterface extends QueryContainerInterface
{

    /**
     * @api
     *
     * @param string $orderReferenceId
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByOrderReferenceId($orderReferenceId);

    /**
     * @api
     *
     * @param string $authorizationReferenceId
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByAuthorizationReferenceId($authorizationReferenceId);

    /**
     * @api
     *
     * @param string $captureReferenceId
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByCaptureReferenceId($captureReferenceId);

    /**
     * @api
     *
     * @param string $refundReferenceId
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByRefundReferenceId($refundReferenceId);

}
