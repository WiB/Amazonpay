<?php

/**
 * Apache OSL-2
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
     * @param string $captureReferenceId
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByCaptureReferenceId($captureReferenceId)
    {
        return $this
            ->queryPayments()
            ->filterByCaptureReferenceId($captureReferenceId);
    }

    /**
     * @api
     *
     * @param string $refundReferenceId
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByRefundReferenceId($refundReferenceId)
    {
        return $this
            ->queryPayments()
            ->filterByRefundReferenceId($refundReferenceId);
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
