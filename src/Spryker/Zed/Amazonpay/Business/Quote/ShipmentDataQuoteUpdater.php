<?php
namespace Spryker\Zed\Amazonpay\Business\Quote;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToShipmentInterface;

class ShipmentDataQuoteUpdater implements QuoteUpdaterInterface
{
    protected $shipmentFacade;

    public function __construct(AmazonpayToShipmentInterface $shipmentFacade)
    {
        $this->shipmentFacade = $shipmentFacade;
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     * 
     * @return QuoteTransfer
     */
    public function update(QuoteTransfer $quoteTransfer)
    {
        $shipmentMethodTransfer = $this->shipmentFacade->getShipmentMethodTransferById(
            $quoteTransfer->getShipment()->getShipmentSelection()
        );

        $quoteTransfer->getShipment()->setMethod($shipmentMethodTransfer);

        return $quoteTransfer;
    }
}