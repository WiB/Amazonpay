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

        $shipmentMethod = new ShipmentMethodTransfer();
        $shipmentMethod->setCarrierName('Amazonpay'); // @todo decalre as constant somwhere
        $shipmentMethod->setName('Amazonpay');
        $shipmentMethod->setDefaultPrice(0);

        $shipment = new ShipmentTransfer();
        $shipment->setMethod($shipmentMethod);

        $quoteTransfer->setPayment($paymentTransfer);
        $quoteTransfer->setShipment($shipment);
        
        return $quoteTransfer;
    }
}