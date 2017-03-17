<?php
namespace Spryker\Zed\Amazonpay\Business\Quote;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Spryker\Shared\Amazonpay\AmazonpayConstants;

class ShipmentDataQuoteUpdater implements QuoteUpdaterInterface
{
    /**
     * @param QuoteTransfer $quoteTransfer
     * 
     * @return QuoteTransfer
     */
    public function update(QuoteTransfer $quoteTransfer)
    {
        $shipmentMethod = new ShipmentMethodTransfer();
        $shipmentMethod->setCarrierName(AmazonpayConstants::PAYMENT_METHOD);
        $shipmentMethod->setName(AmazonpayConstants::PAYMENT_METHOD);
        $shipmentMethod->setDefaultPrice(0);
        $shipmentMethod->setIdShipmentMethod(1); //@todo retrieve shipment method from DB instead
        $shipmentMethod->setFkShipmentCarrier(1);//@todo same

        $shipment = new ShipmentTransfer();
        $shipment->setMethod($shipmentMethod);

        $quoteTransfer->setShipment($shipment);

        return $quoteTransfer;
    }
}