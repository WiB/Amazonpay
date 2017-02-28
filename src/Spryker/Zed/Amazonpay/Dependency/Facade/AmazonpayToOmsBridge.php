<?php
namespace Spryker\Zed\Amazonpay\Dependency\Facade;

use Propel\Runtime\Collection\ObjectCollection;

class AmazonpayToOmsBridge implements AmazonpayToOmsInterface
{

    /**
     * @var \Spryker\Zed\Oms\Business\OmsFacadeInterface
     */
    protected $omsFacade;

    /**
     * @param \Spryker\Zed\Oms\Business\OmsFacadeInterface $omsFacade
     */
    public function __construct($omsFacade)
    {
        $this->omsFacade = $omsFacade;
    }

    /**
     * @param string $eventId
     * @param \Propel\Runtime\Collection\ObjectCollection $orderItems
     * @param array $logContext
     * @param array $data
     *
     * @return array
     */
    public function triggerEvent($eventId, ObjectCollection $orderItems, array $logContext, array $data = [])
    {
        return $this->omsFacade->triggerEvent($eventId, $orderItems, $logContext, $data);
    }

}
