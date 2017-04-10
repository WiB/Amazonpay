<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \Spryker\Zed\Amazonpay\Persistence\AmazonpayPersistenceFactory getFactory()
 */
class AmazonpayQueryContainer extends AbstractQueryContainer implements AmazonpayQueryContainerInterface
{

    /**
     * @api
     *
     * @param string $orderReferenceId
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByOrderReferenceId($orderReferenceId)
    {
        return $this
            ->queryPayments()
            ->filterByOrderReferenceId($orderReferenceId);
    }

    /**
     * @api
     *
     * @param string $authorizationReferenceId
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByAuthorizationReferenceId($authorizationReferenceId)
    {
        return $this
            ->queryPayments()
            ->filterByAuthorizationReferenceId($authorizationReferenceId);
    }

    /**
     * @api
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery
     */
    protected function queryPayments()
    {
        return $this
            ->getFactory()
            ->createPaymentAmazonpayQuery();
    }

}
