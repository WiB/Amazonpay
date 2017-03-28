<?php
namespace Spryker\Zed\Amazonpay\Dependency\Facade;

use Propel\Runtime\Collection\ObjectCollection;

interface AmazonpayToOmsInterface
{

    /**
     * @param string $eventId
     * @param \Propel\Runtime\Collection\ObjectCollection $orderItems
     * @param array $logContext
     * @param array $data
     *
     * @return array
     */
    public function triggerEvent($eventId, ObjectCollection $orderItems, array $logContext, array $data = []);

}
