<?php
namespace Spryker\Zed\Amazonpay\Business\Model;

use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

class QuoteDataUpdater
{
    /**
     * @param QuoteTransfer $quoteTransfer
     * 
     * @return QuoteTransfer
     */
    public function update(QuoteTransfer $quoteTransfer)
    {
        $paymentTransfer = new PaymentTransfer();
        $paymentTransfer->setPaymentMethod('Amazonpay'); // @todo decalre as constant somwhere
        $paymentTransfer->setPaymentProvider('Amazonpay');
        $paymentTransfer->setPaymentSelection('Amazonpay');

        $shipmentMethod = new ShipmentMethodTransfer();
        $shipmentMethod->setCarrierName('Amazonpay');
        $shipmentMethod->setName('Amazonpay');
        $shipmentMethod->setDefaultPrice(0);
        $shipmentMethod->setIdShipmentMethod(3);
        $shipmentMethod->setFkShipmentCarrier(2);

        $shipment = new ShipmentTransfer();
        $shipment->setMethod($shipmentMethod);

        $quoteTransfer->setPayment($paymentTransfer);
        $quoteTransfer->setShipment($shipment);

        return $quoteTransfer;
    }
}